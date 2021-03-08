<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\WorkCondition;
use App\Rules\JobCategory;
use App\Rules\JobType;
use App\Rules\WorkConditionRules;
use App\Services\MessageResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPostController extends Controller
{

    public function createJob(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => ['required','string','min:4'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'work_condition' => ['required',new WorkConditionRules()],
            'type' =>['required',new JobType()],
            'category' => ['required',new JobCategory()],
            'salary' => ['required','string', 'min:7'],
            'benefits' => ['required', 'string']
        ]);

        if($validator->fails()){
            $response = MessageResponse::errorResponse("Unable to post job", $validator->errors());
            return response()->json($response, 400);
        }

        $filter = explode($request->title);
        $lastRefSegement="";

        foreach ($filter as $filters){
            $lastRef .=$filters[0];
        }


        $id = 'FJB-'.random(10000,99999).'-'.$lastRefSegement;
//       $work_condition = WorkCondition::where('work_condition', $request->work_condition)->get('id');
        JobPost::create([
            //company
            'id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'work_condition' => $request->work_condition,
            'type' =>$request->type,
            'category' => $request->category,
            'salary' => $request->salary,
            'benefits' => $request->benefits


        ]);
    }


}
