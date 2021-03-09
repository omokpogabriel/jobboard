<?php

namespace App\Http\Middleware;

use App\Services\MessageResponse;
use Closure;
use Illuminate\Http\Request;

class BusinessUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!isset(auth()->user()->id ) ||  auth()->user()->roles != "business"){
            return response()->json(MessageResponse::errorResponse("Not Authorization set. Please login as a Business"), 401 );
        }

        return $next($request);
    }
}
