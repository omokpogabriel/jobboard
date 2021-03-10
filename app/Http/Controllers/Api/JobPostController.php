<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\User;
use App\Models\WorkCondition;
use App\Rules\JobCategory;
use App\Rules\JobType;
use App\Rules\WorkConditionRules;
use App\Services\CustomValidation;
use App\Services\MessageResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JobPostController extends Controller
{

    /**
     *  creates a new job post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createJob(Request $request){

        // validates the user input
        $validator = Validator::make($request->all(),[
            'title' => ['required','string','min:3'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'work_condition' => ['required',new WorkConditionRules()],
            'type' =>['required',new JobType()],
            'category' => ['required',new JobCategory()],
            'salary' => ['required','string', 'min:7'],
            'benefits' => ['required', 'string']
        ]);

        // checks if validation fails, return a 400 response if true
        if($validator->fails()){
            $response = MessageResponse::errorResponse("Bad input format", $validator->errors());
            return response()->json($response, 400);
        }

        /**
         *  creates a special job post id by exploding the job title,
         * loops through the array and concatinates each first character
         * then concatinates a randomly generated integer with FJB and the $lastRefSegement
        */
        $explode_title = explode(" ",$request->title);
        $lastRefSegement="";
        foreach ($explode_title as $filter){
            $lastRefSegement .=$filter[0];
        }
        $id = 'FJB-'.\rand(10000,99999).'-'.$lastRefSegement;

        // stores the new job post
        $post = User::findOrFail(auth()->user()->id)->jobposts()->create([

            'title' => $request->title,
            'id' => $id,
            'description' => $request->description,
            'location' => $request->location,
            'company' => auth()->user()->name,
            'company_logo' => auth()->user()->avatar,
            'work_condition' => $request->work_condition,
            'type' =>$request->type,
            'category' => $request->category,
            'salary' => $request->salary,
            'benefits' => $request->benefits,
//            'posted_by' => auth()->user()->id
        ]);

        if(!$post){
            $response = MessageResponse::errorResponse("Unable to post job");
            return response()->json($response, 500);
        }

        $response = MessageResponse::successResponse("Job Successfully created",);
        return response()->json($response, 200);
    }

    /**
     * deletes a job post
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteJob($id){

        // gets a user post and deletes it
        $remove_post = JobPost::where(['posted_by'=> auth()->user()->id, 'id'=> $id])->delete();

        // checks if a post was actually deleted, if fails, returns 404 indicating that job was not found
        if($remove_post ==0){
            $response = MessageResponse::errorResponse("Unable to delete job post");
            return response()->json($response, 404);
        }

        // returns success
        $response = MessageResponse::successResponse("Job Successfully Deleted");
        return response()->json($response);

    }

    /**
     * gets a single job post by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showJob($id){
        try{
            $fetch_post = JobPost::findOrFail($id);
            return response()->json($fetch_post, 200);
        }catch (ModelNotFoundException $ex){
            return response()->json("JOB ID: $id NOT FOUND", 404);
        }


    }

    /**
     * gets all job posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllJobs(){
            $post = JobPost::paginate(15);
            return response()->json($post, 200);
    }

    /**
     * gets all job posts by the logged in user
     *
     * this action performs two functions
     *
     * 1. gets all the job posts by the user
     * 2. searches for job post with q= query parameter
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showMyJobs(){
        /**
         * counts the number of query parameter in the request
         *
         * this is useful for check if check if this is a query search or not
         */
        $hasQueries = count(request()->query() );

        if($hasQueries > 0 ){
            // there is a query parameter since query is more than 1

            if(request()->has('q')){
                // checks if the query name is 'q'
                return CustomValidation::queryJobs(request()->all());
            }else{
                $response = MessageResponse::errorResponse("Unknown request query name",);
                return response()->json($response, 404);
            }
        }else{

            // this is not a query search
            $post = JobPost::where('posted_by', auth()->user()->id)->paginate(15);
            return response()->json($post, 200);
        }


    }

    /**
     * updates the title of a search
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatemyJobs(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'title' => ['required','string','min:3'],
        ]);

        if($validator->fails()){
            $response = MessageResponse::errorResponse("invalid input", $validator->errors());
            return response()->json($response, 400);
        }

        try{
            $post = JobPost::findOrFail($id);
            $post->title = $request->title;
            $post->save();

            return response()->json($post);
        }catch (ModelNotFoundException $ex){
            return response()->json("JOB ID: $id NOT FOUND", 404);
        }
    }



}
