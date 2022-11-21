<?php

namespace App\Http\Controllers;
use App\Job;
use App\Alert;
use App\Industry;
use DB;
use Mail;
use App\Mail\AlertJobsMail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Helpers\DataArrayHelper;

class AlertCronController extends Controller
{

    public function index(){
    	$alerts = Alert::get();
    	if(null!==($alerts)){
    		foreach ($alerts as $key => $alert) {
				$search = $alert->search_title;
    			$country_id = $alert->country_id;
    			$state_id = $alert->state_id;
    			$city_id = $alert->city_id;
    			$functional_area_id = $alert->functional_area_id;
    			$salary_offered_ids = $alert->salary_offered_ids;
    			$job_type_ids = $alert->job_type_ids;
    			$career_level_ids = $alert->career_level_ids;
    			$job_experience_ids = $alert->job_experience_ids;
    			$degree_level_ids = $alert->degree_level_ids;
    		   	$query = Job::select('*');
    		   	$query->where('created_at', '>=', Carbon::now()->subDay(30));
	           	if ($search != '') {
	                     $query->Where('title', 'like', '%' . $search . '%');
	            }
	            if ($country_id != '') {
	                
	                $query->where('country_id',$country_id);
	                       
	            }
	            if ($state_id != '') {
	                
	                $query->where('state_id',$state_id);
	                       
	            }
	            if ($city_id != '') {
	                
	                $query->where('city_id',$city_id);
	                       
	            }
	            if ($functional_area_id	!= '') {
	                
	                $query->where('functional_area_id',$functional_area_id);
	                       
	            }
				if ($salary_offered_ids	!= '') {
					$salaryOfferedIdArray = explode(',', $salary_offered_ids);
					$salaryMinId = min($salaryOfferedIdArray);
					$salaryMaxId = max($salaryOfferedIdArray);
					$salaryArray = DataArrayHelper::defaultSalaryOfferedArray();
					$salaryFrom = explode("-", $salaryArray[$salaryMinId]);
					$salaryTo = explode("-", $salaryArray[$salaryMaxId]);
					$query->where('salary_from', '>=', $salaryFrom[0]);
					$query->where('salary_to', '<=', $salaryTo[1]);     
	            }
				if ($job_type_ids	!= '') {
	                $jobTypeArray = explode(',', $job_type_ids);
	                $query->whereIn('job_type_id', $jobTypeArray);
	            }
				if ($career_level_ids	!= '') {
	                $careerLevelArray = explode(',', $career_level_ids);
	                $query->whereIn('career_level_id', $careerLevelArray);      
	            }
				if ($job_experience_ids	!= '') {
	                $experienceArray = explode(',', $job_experience_ids);
	                $query->whereIn('job_experience_id', $experienceArray); 
	            }
				if ($degree_level_ids != '') {
	                $degreeArray = explode(',', $degree_level_ids);
	                $query->whereIn('degree_level_id', $degreeArray); 
	            }

	            
                $query->orderBy('jobs.id', 'DESC'); 

            	$jobs = $query->active()->take(10)->get();

				$search_location = '';
            	if(null!==($jobs) && count($jobs)>0){
            		if($search_location != '') {
            			$loca = $search_location;
            		}else{
            			$loca = 'Netherlands';
            		}
			        $data['email'] = $alert->email;
			        $data['subject'] = count($jobs).' new '.$alert->search_title.' jobs in '.$loca;
			        $data['jobs'] = $jobs;


			        Mail::send(new AlertJobsMail($data));
            	}

            	
    		}
    	}
    }

}