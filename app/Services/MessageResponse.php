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
            $response["data"] =  is_array($data)? $data : json_decode ($data);
        }
        return $response;
    }
    public static function successResponse( $message,  $data = null  ): Array{
        $response = ["status"=>"success"];
        $response["message"] = $message;
        if(isset($data)){
                $response["data"] =  is_array($data)? $data : json_decode ($data);
        }

        return $response;
    }
}
