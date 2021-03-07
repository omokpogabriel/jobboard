<?php


namespace App\Services;


use GuzzleHttp\Exception\InvalidArgumentException;
use function \json_decode;

class MessageResponse
{

    public static function errorResponse( $message,$data = null  ): Array{
        $response = ["status"=>"Failed"];
        $response["message"] = $message;
        if(isset($data)){
            try{
                $response["data"] = json_decode($data);
            }catch(Exception $ex){
                $response["data"] = $data;
            }
        }



        return $response;
    }
    public static function successResponse( $message,  $data = null  ): Array{
        $response = ["status"=>"success"];
        $response["message"] = $message;
        if(isset($data)){
            try{
                $response["data"] = json_decode ($data);
            }catch(Exception $ex){
                $response["data"] = $data;
            }
        }


        return $response;
    }
}
