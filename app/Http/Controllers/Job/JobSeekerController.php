<?php

namespace App\Http\Controllers\Job;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\City;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobSeekers;

class JobSeekerController extends Controller
{

    //use Skills;
    use FetchJobSeekers;

    private $functionalAreas = '';
    private $countries = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('company');
        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->countries = DataArrayHelper::langCountriesArray();
    }

    public function jobSeekersBySearch(Request $request)
    {
        $search = $request->query('search', '');
        $city = $request->query('city', '');
        $functional_area_ids = $request->query('functional_area_id', array());
        $industry_ids = $request->query('industry_id', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $job_skill_ids = $request->query('job_skill_id', array());
        $order_by = $request->query('order_by', 'DESC');

        $limit = 5;
        $cityId = '';
        $city_ids = [];

        $order = ($order_by == "1" || $order_by == "DESC") ? 'DESC' : 'ASC';

        if (!is_null($city) && $city != '') {
            $cityname = explode(",", $city);
            $cityData = City::where('city', $cityname)->get('id')->toArray();
            $city_ids[] = !empty($cityData) ? $cityData[0]['id'] : '';
            $cityId = !empty($cityData) ? $cityData[0]['id'] : '';
            $city = !empty($cityData) ? $city : '';
        }

        $jobSeekers = $this->fetchJobSeekers($search, $industry_ids, $functional_area_ids, $city_ids, $job_experience_ids, $job_skill_ids, $order, $limit);

        /*         * ************************************************** */

        $jobSeekerIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $city_ids, $job_experience_ids, $job_skill_ids, 'users.id');

        /*         * ************************************************** */

        $skillIdsArray = $this->fetchSkillIdsArray($jobSeekerIdsArray);

        /*         * ************************************************** */

        $cityIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $city_ids, $job_experience_ids, $job_skill_ids, 'users.city_id');

        /*         * ************************************************** */

        $industryIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $city_ids, $job_experience_ids, $job_skill_ids, 'users.industry_id');

        /*         * ************************************************** */


        /*         * ************************************************** */

        $functionalAreaIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $city_ids, $job_experience_ids, $job_skill_ids, 'users.functional_area_id');

        /*         * ************************************************** */

        $jobExperienceIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $city_ids, $job_experience_ids, $job_skill_ids, 'users.job_experience_id');

        /*         * ************************************************** */

        $seoArray = $this->getSEO($functional_area_ids, $city_ids, $job_experience_ids);

        /*         * ************************************************** */

        $currencies = DataArrayHelper::currenciesArray();

        /*         * ************************************************** */

        $seo = (object) array(
                    'seo_title' => $seoArray['description'],
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );
        return view('user.list')
            ->with('functionalAreas', $this->functionalAreas)
            ->with('jobSeekers', $jobSeekers)
            ->with('skillIdsArray', $skillIdsArray)
            ->with('cityIdsArray', $cityIdsArray)
            ->with('industryIdsArray', $industryIdsArray)
            ->with('functionalAreaIdsArray', $functionalAreaIdsArray)
            ->with('jobExperienceIdsArray', $jobExperienceIdsArray)
            ->with('seo', $seo)                        
            ->with('city', $city)
            ->with('search', $search)
            ->with('cityId', $cityId)
            ->with('order_by', $order_by);
    }

}