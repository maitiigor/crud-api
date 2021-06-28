<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Events\UserRegistered;

class AuthController extends Controller
{
    //


    public function _construct(){
        // setting up authentication middleware
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    protected function guard(){
        return Auth::guard();
    }
    public function register(Request $request){
        // Validating Registration data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'picture' => 'required|image|mimes:jpg,png|max:2048',
            'password' => 'required',
            'phone_number' => 'required',
            'c_password' => 'required|same:password',
            ]);
        if ($validator->fails()){
            return response()->json((['error' => $validator->errors()]),400);
        }
        $imageName = $request->picture->getClientOriginalName().'.'.$request->picture->extension();
        $request->picture->move(public_path('images'),$imageName);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->picture_url = $imageName;
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->save();

        event(new UserRegistered($user)); // Passing Registration event to handle for notification
    return response()->json('Registration successful',201);
    }
    public function login(Request $request){
        // validating Loin data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',

        ]);
        if ($validator->fails()){
            return response()->json((['error' => $validator->errors()]),400);
        }
        $token_validitity = 24 * 60;
        $this->guard()->factory()->setTTl($token_validitity);
        $credentials = $validator->validated();
        if (! $token = $this->guard()->attempt($credentials)){
            return response()->json(['error' => 'unauthorised']);
        }
        return $this->respondWithToken($token);
    }
    /*public function logout(){
        auth()->json(['message' => 'successfully logout']);
    }*/

    public function me(){
        $user =$this->guard()->user();
        return response()->json($user);
    }
    public function refresh(){

        return $this->respondWithToken($this->guard()->refresh());
    }
    public function logout(){
        // handling user logout
        $this->guard()->login();
      return response()->json(['message' => 'successfully logout']);
    }

    protected function respondWithToken($token){
        // returning the authentication token
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'token_validity' => $this->guard()->factory()->getTTL() * 60
            ]);
    }
}
