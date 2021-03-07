<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Rules\JobType;
use App\Rules\WorkConditionRules;
use App\Services\MessageResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createJob(Request $request)
    {
        $validator = Validator::make($request,[
            'work_condition' => ['required',new WorkConditionRules()],
            'type' =>['required',new JobType()],
            'category' => ['required',new JobCategory()],
            'title' => ['required','string','min:4'],
            'company' => ['required', 'string', 'min:3'],
            'company_logo' => ['string'],
            'salary' => ['required','string', 'min:7'],
            'description' => ['required', 'string'],
            'benefits' => ['required', 'string'],
        ]);

        if($validator->fails()){
            $response = MessageResponse::errorResponse("Unable to post job", $validator->errors());
            return response($response, 409);
        }

        // create new job post
        JobPost::create([

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
