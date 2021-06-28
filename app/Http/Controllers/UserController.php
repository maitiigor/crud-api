<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function _construct(){

    }
    public function updateUserDetails($id, Request $request){
        // Editing User details
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',

        ]);
        if ($validator->fails()){
            return response()->json((['error' => $validator->errors()]),400);
        }
        //$imageName = $request->picture->getClientOriginalName().'.'.$request->picture->extension();
        //$request->picture->move(public_path('images'),$imageName);

        $update = User::where('id',$id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);

        if($update){
           return response()->json(['message' => 'update successful'],201);
        }

    }
    public function fetchUser(){
        //Fetching all users
        $users = User::all();
        return response()->json(['details' => $users],201);
    }
    public function deleteUser($id){
        // Deleting User
        $query = User::destroy($id);
        If($query){
            return response()->json(['success'=> 'Successful']);
        }
            return response()->json(['failure' => 'something went wrong']);
    }
}
