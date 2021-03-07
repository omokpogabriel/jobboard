<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Roles;
use App\Services\MessageResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json("welcome to my json", 200);
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
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','min:3'],
            'email' => ['required','email','min:5','unique:users'],
            'password' => ['required','string', 'min:6'],
            'role' => [new Roles()]
        ]);

        if ($validator->fails()) {
            $response = MessageResponse::errorResponse("Unable to create New User", $validator->errors());
            return response($response, 409);
        }

        // creates a default avatar url based on the user name
        $avatar = "https://ui-avatars.com/api/?name=".rawurlencode($request->name);

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
            'avatar' => $avatar
        ]);

        // tries to log user in after registration
        $credentials = $request->only('email','password');
            //['email'=>$request->email, 'password'=>$request->password];
        if(!auth()->attempt($credentials)){
            $response = MessageResponse::successResponse("Please log in to continue");
            return response()->json($response);
        }

        $response = MessageResponse::successResponse("User Created Successful", $user);
        return response()->json($response);
    }

    public function logout(){
        if(auth()->check()){
            auth()->logout();
            return \response()->json(MessageResponse::successResponse("Successfully logged out user"));
        }

        return \response()->json(MessageResponse::errorResponse("User not logged in"));

    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => ['required','email','min:5'],
            'password' => ['required','string', 'min:6'],
        ]);

        if ($validator->fails()) {
            // 401 Unauthorized, The requested page needs a username and a password.
            $response = MessageResponse::errorResponse("Invalid Credentials", $validator->errors());
            return response($response, 401);
        }

//        if(auth()->check()){
//            $request->session()->regenerate();
//            // regenerate jwt token here
//        }

        $credentials = $request->only('email','password');
        // return 401 Unauthorized user for failed login
        if(!auth()->attempt($credentials) ){
            // 401 Unauthorized, The requested page needs a username and a password.
            $response = MessageResponse::errorResponse("Login failed");
            return response($response, 401);
        }

        return \response()
            ->json(MessageResponse::successResponse("Login successful",
                                                    ['token'=>'']
                                                    ));

    }
}
