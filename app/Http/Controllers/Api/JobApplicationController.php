<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobApplicate;
use App\Models\JobPost;
use App\Services\MessageResponse;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends Controller
{

    /**
     * creates a new application
     *
     * @param Request $request
     * @param $job_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(Request  $request, $job_id){


        // validate the user input
        $validator = Validator::make($request->all(),
            [
            'first_name' => ['required','string','min:3'],
            'last_name' => ['required','string','min:3'],
            'email' => ['required','email'],
            'phone' => ['required','string','min:8','max:13'],
            'location' => ['required','string','min:3'],
            'cv' => ['required','mimes:pdf,doc,docx,jpeg,bmp,png']

        ]);

        // check if validation fails, if true , send failed messages back to the user
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        // using try/catch because of the findOrFail
        try{

            // create a new unique name for the uploaded cv
            $cv_name = $request->first_name.'_'.$request->last_name.'_'.$job_id.'_'.uniqid();

            //check if the job id exist, get the object if true
            $job = JobPost::findOrFail($job_id);

            // save the uploaded file
            $cv_path  =  $request->file('cv')->storeAs('cvs', $cv_name);

            // save the new application
            $job->applicates()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'cv' => $cv_path,
            ]);
        }catch (ModelNotFoundException $ex){
            return response()->json("JOB ID: $job_id NOT FOUND", 404);
        }

        $response = MessageResponse::successResponse("Application Successfully Submitted");
        return response()->json($response);


    }

    /**
     * gets an application by id
     *
     * @param $job_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function applications($job_id){

            //check if the job id exist, get the object if true
            $applications = JobApplicate::where('job_id',$job_id);  //;;

            // checks if application with job_id exists in the model
            if(!$applications->exists()) {
                $response = MessageResponse::errorResponse("JOB APPLICATION : $job_id NOT FOUND");
                return response()->json($response, 404);
            }

            return response()->json($applications->paginate(15) );


    }

    /**
     * gets all applications
     * @return \Illuminate\Http\JsonResponse
     */
    public function allapplications(){

            //check if the job id exist, get the object if true
            $applications = JobApplicate::paginate(15);  //;;
            return response()->json($applications);
    }
}
