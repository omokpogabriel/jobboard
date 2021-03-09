<?php


namespace App\Services;


use App\Models\JobPost;

class CustomValidation
{
    public static function queryJobs($query){
        $validator = Validator($query,[
            'q' => ['string', 'min:3']
        ]);

        if($validator->fails()){
            $response = MessageResponse::errorResponse("query validator failed",$validator->errors());
            return response()->json($response, 500);
        }

        $post = JobPost::where( function($builder) use($query) {
            return $builder->where('title', 'LIKE', '%'.$query['q'] .'%');
        })->paginate(15);
        return response()->json($post, 200);

    }
}
