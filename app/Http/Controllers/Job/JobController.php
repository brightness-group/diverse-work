<?php

namespace App\Http\Controllers\Job;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\Job;
use App\JobApply;
use App\FavouriteJob;
use App\Company;
use App\JobSkill;
use App\JobSkillManager;
use App\Country;
use App\CountryDetail;
use App\State;
use App\City;
use App\CareerLevel;
use App\FunctionalArea;
use App\Industry;
use App\JobType;
use App\JobShift;
use App\Gender;
use App\JobExperience;
use App\DegreeLevel;
use App\ProfileCv;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\JobFormRequest;
use App\Http\Requests\Front\ApplyJobFormRequest;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobs;
use App\Events\JobApplied;

class JobController extends Controller
{

    //use Skills;
    use FetchJobs;

    private $functionalAreas = '';
    private $countries = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['jobsBySearch', 'jobDetail', 'jobsSearch', 'autocomplete']]);

        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->countries = DataArrayHelper::langCountriesArray();
        $this->salaryOffered = DataArrayHelper::langSalaryOfferedArray();
        $this->defaultSalaryOffered = DataArrayHelper::defaultSalaryOfferedArray();

    }

    public function jobsBySearch(Request $request)
    {
        $search = $request->query('search', '');
        $functional_area_ids = $request->query('functional_area_id', array());
        $country_ids = $request->query('country_id', array());
        $city_ids = $request->query('city_id', array());
        $career_level_ids = $request->query('career_level_id', array());
        $job_type_ids = $request->query('job_type_id', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $salary_from = $request->query('salary_from', '');
        $salary_to = $request->query('salary_to', '');
        $salary_currency = $request->query('salary_currency', '');
        $industry_ids = $request->query('industry_id', array());
        $order_by = $request->query('order_by', 'DESC');
        $salary_offered_ids = $request->query('salary_offered_id', array());
        $degree_level_ids = $request->query('degree_level_id', array());
        $city = $request->query('city', '');
        $limit = 5;
        $industry = '';
        $cityId = '';

        $order = ($order_by == "1" || $order_by == "DESC") ? 'DESC' : 'ASC';

        if (!empty($salary_offered_ids)) {
            $salaryMinId = min($salary_offered_ids);
            $salaryMaxId = max($salary_offered_ids);
            $salaryFrom = explode("-", $this->defaultSalaryOffered[$salaryMinId]);
            $salaryTo = explode("-", $this->defaultSalaryOffered[$salaryMaxId]);

            $salary_to = $salaryTo[1];
            $salary_from = $salaryFrom[0];

            $salary_from = $request->query('salary_from', $salaryFrom[0]);
            $salary_to = $request->query('salary_to', $salaryTo[1]);
        }
        
        if (!is_null($city) && $city != '') {
            $cityname = explode(",", $city);
            $cityData = City::where('city', $cityname)->get('id')->toArray();
            $city_ids[] = !empty($cityData) ? $cityData[0]['id'] : '';
            $cityId = !empty($cityData) ? $cityData[0]['id'] : '';
            $city = !empty($cityData) ? $city : '';
        }

        if (!empty($industry_ids)) {
            $industryData = Industry::where('industry_id', $industry_ids[0])->get('industry')->toArray();
            $industry = !empty($industryData) ? $industryData[0]['industry'] : '';
        }

        $jobs = $this->fetchJobsByCriteria($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, $order, $limit);
       
        /*         * ************************************************** */

        $jobIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids,  $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.id');

        /*         * ************************************************** */

        $skillIdsArray = $this->fetchSkillIdsArray($jobIdsArray);

        /*         * ************************************************** */

        $countryIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids,  $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.country_id');

        /*         * ************************************************** */

        $stateIdsArray = $this->fetchIdsArray($search,  $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.state_id');

        /*         * ************************************************** */

        $cityIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids,  $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.city_id');

        /*         * ************************************************** */

        $companyIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.company_id');

        /*         * ************************************************** */

        $industryIdsArray = $this->fetchIndustryIdsArray($companyIdsArray);

        /*         * ************************************************** */

        $functionalAreaIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.functional_area_id');

        /*         * ************************************************** */

        $careerLevelIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.career_level_id');

        /*         * ************************************************** */

        $jobTypeIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.job_type_id');

        /*         * ************************************************** */

        $jobExperienceIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.job_experience_id');

        /*         * ************************************************** */

        $salaryOfferedIdsArray = $this->fetchIdsArrayForSalaryOffered($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $city_ids, $industry_ids, $degree_level_ids, $this->defaultSalaryOffered);

        /*         * ************************************************** */

        $degreeLevelIdsArray = $this->fetchIdsArray($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $city_ids, $industry_ids, $degree_level_ids, 'jobs.degree_level_id');

        /*         * ************************************************** */

        $seoArray = $this->getSEO($functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids);

        /*         * ************************************************** */

        $currencies = DataArrayHelper::currenciesArray();

        /*         * ************************************************** */

        $jobTypes = ''; $jobTyprArray = [];
        if (!empty($job_type_ids)) {
            foreach($jobTypeIdsArray as $key=>$job_type_id) {
                if (in_array($job_type_id, $job_type_ids)) {
                    $jobType = JobType::where('job_type_id','=',$job_type_id)->lang()->active()->first();
                    $jobTyprArray[] = $jobType->job_type;
                }
            }
            $jobTypes = !empty($jobTyprArray) ? implode(", ", $jobTyprArray) : '';
        }

        $seo = (object) array(
                    'seo_title' => $seoArray['description'],
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );
        return view('job.list')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('salaryOffered', $this->salaryOffered)
                        ->with('countries', $this->countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('jobs', $jobs)
                        ->with('skillIdsArray', $skillIdsArray)
                        ->with('countryIdsArray', $countryIdsArray)
                        // ->with('cityIdsArray', $cityIdsArray)
                        ->with('functionalAreaIdsArray', $functionalAreaIdsArray)
                        ->with('careerLevelIdsArray', $careerLevelIdsArray)
                        ->with('jobTypeIdsArray', $jobTypeIdsArray)
                        ->with('jobExperienceIdsArray', $jobExperienceIdsArray)
                        ->with('degreeLevelIdsArray', $degreeLevelIdsArray)
                        ->with('salaryOfferedIdsArray', $salaryOfferedIdsArray)                        
                        ->with('seo', $seo)
                        ->with('city', $city)
                        ->with('search', $search)
                        ->with('industry', $industry)
                        ->with('jobTypes', $jobTypes)
                        ->with('cityId', $cityId)
                        ->with('order_by', $order_by);
    }

    public function jobDetail(Request $request, $job_slug)
    {

        $job = Job::where('slug', 'like', $job_slug)->firstOrFail();
        /*         * ************************************************** */
        $search = '';
        $job_titles = array();
        $company_ids = array();
        $industry_ids = array();
        $job_skill_ids = (array) $job->getJobSkillsArray();
        $functional_area_ids = (array) $job->getFunctionalArea('functional_area_id');
        $country_ids = (array) $job->getCountry('country_id');
        $state_ids = (array) $job->getState('state_id');
        $city_ids = (array) $job->getCity('city_id');
        $is_freelance = $job->is_freelance;
        $career_level_ids = (array) $job->getCareerLevel('career_level_id');
        $job_type_ids = (array) $job->getJobType('job_type_id');
        $job_shift_ids = (array) $job->getJobShift('job_shift_id');
        $gender_ids = (array) $job->getGender('gender_id');
        $degree_level_ids = (array) $job->getDegreeLevel('degree_level_id');
        $job_experience_ids = (array) $job->getJobExperience('job_experience_id');
        $salary_from = 0;
        $salary_to = 0;
        $salary_currency = '';
        $is_featured = 2;
        $order_by = 'id';
        $limit = 5;


        $relatedJobs = $this->fetchJobs($search, $functional_area_ids, $country_ids, $career_level_ids, $job_type_ids, $job_experience_ids, $salary_from, $salary_to, $order_by, $limit);
        /*         * ***************************************** */

        $seoArray = $this->getSEO((array) $job->functional_area_id, (array) $job->country_id, (array) $job->state_id, (array) $job->city_id, (array) $job->career_level_id, (array) $job->job_type_id, (array) $job->job_shift_id, (array) $job->gender_id, (array) $job->degree_level_id, (array) $job->job_experience_id);

        /*         * ************************************************** */
        $seo = (object) array(
                    'seo_title' => $job->title,
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );
        return view('job.detail')
                        ->with('job', $job)
                        ->with('relatedJobs', $relatedJobs)
                        ->with('seo', $seo);
    }

    /*     * ************************************************** */

    public function addToFavouriteJob(Request $request, $job_slug)
    {
        $data['job_slug'] = $job_slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteJob::create($data);
        flash(__('Job has been added in favorites list'))->success();
        return \Redirect::route('job.detail', $job_slug);
    }

    public function removeFromFavouriteJob(Request $request, $job_slug)
    {
        $user_id = Auth::user()->id;
        FavouriteJob::where('job_slug', 'like', $job_slug)->where('user_id', $user_id)->delete();

        flash(__('Job has been removed from favorites list'))->success();
        return \Redirect::route('job.detail', $job_slug);
    }

    public function applyJob(Request $request, $job_slug)
    {
        $user = Auth::user();
        $job = Job::where('slug', 'like', $job_slug)->first();
        
        if ((bool)$user->is_active === false) {
            flash(__('Your account is inactive contact site admin to activate it'))->error();
            return \Redirect::route('job.detail', $job_slug);
            exit;
        }
        
        if ((bool) config('jobseeker.is_jobseeker_package_active')) {
            if (
                    ($user->jobs_quota <= $user->availed_jobs_quota) ||
                    ($user->package_end_date->lt(Carbon::now()))
            ) {
                flash(__('Please subscribe to package first'))->error();
                return \Redirect::route('home');
                exit;
            }
        }
        if ($user->isAppliedOnJob($job->id)) {
            flash(__('You have already applied for this job'))->success();
            return \Redirect::route('job.detail', $job_slug);
            exit;
        }
        
        

        $myCvs = ProfileCv::where('user_id', '=', $user->id)->pluck('title', 'id')->toArray();

        return view('job.apply_job_form')
                        ->with('job_slug', $job_slug)
                        ->with('job', $job)
                        ->with('myCvs', $myCvs);
    }

    public function postApplyJob(ApplyJobFormRequest $request, $job_slug)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $job = Job::where('slug', 'like', $job_slug)->first();

        $jobApply = new JobApply();
        $jobApply->user_id = $user_id;
        $jobApply->job_id = $job->id;
        $jobApply->cv_id = $request->post('cv_id');
        $jobApply->current_salary = $request->post('current_salary');
        $jobApply->expected_salary = $request->post('expected_salary');
        $jobApply->salary_currency = $request->post('salary_currency');
        $jobApply->save();

        /*         * ******************************* */
        if ((bool) config('jobseeker.is_jobseeker_package_active')) {
            $user->availed_jobs_quota = $user->availed_jobs_quota + 1;
            $user->update();
        }
        /*         * ******************************* */
        event(new JobApplied($job, $jobApply));

        flash(__('You have successfully applied for this job'))->success();
        return \Redirect::route('job.detail', $job_slug);
    }

    public function myJobApplications(Request $request)
    {
        $myAppliedJobIds = Auth::user()->getAppliedJobIdsArray();
        $jobs = Job::whereIn('id', $myAppliedJobIds)->paginate(10);
        return view('job.my_applied_jobs')
                        ->with('jobs', $jobs);
    }

    public function myFavouriteJobs(Request $request)
    {
        $myFavouriteJobSlugs = Auth::user()->getFavouriteJobSlugsArray();
        $jobs = Job::whereIn('slug', $myFavouriteJobSlugs)->paginate(10);
        return view('job.my_favourite_jobs')
                        ->with('jobs', $jobs);
    }

     /**
     * Return cities with state name.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $requestString = $request->toArray();
        $query = $requestString['query'];   
        $data = array();
        $cities = City::select("city", "states.state")
                ->leftJoin('states', 'cities.state_id', '=', 'states.id')
                ->where("city","LIKE","%{$query}%")
                // ->whereIn("states.country_id", [154, 155])
                ->get();
        foreach ($cities as $city) {
            $data[] = $city->city.", ".$city->state;
        }
        return response()->json($data);
    }

}
