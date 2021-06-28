<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AssetAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\AssetAssignmentCreated;


class AssetAssignmentController extends Controller
{
    //
    public function _construct(){
    $this->middleware('auth:api');
    }
    public function create(Request $request){
        //verifying form data
        $validator = Validator::make($request->all(),[
           'asset_id' => 'required',
            'assignment_date' => 'required',
            'status' => 'required',
            'due_date' => 'required',
            'assigned_user_id' => 'required',

        ]);
        //If validation fails return back error to user
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()],400);
        }
        // creating the Asset Assignment
        $asset_assignment = AssetAssignment::create([
            'asset_id' => $request->asset_id,
            'assignment_date' =>  Carbon::parse($request->assignment_date),
            'status' => $request->status,
            'due_date' => Carbon::parse($request->due_date),
            'assigned_user_id' => $request->assigned_user_id,
            'assigned_by' => Auth::id(), //Getting the Logged in UserID
            ]);
        if($asset_assignment){
            event(new AssetAssignmentCreated($asset_assignment)); // Passing event
            return response()->json('success',201); //response if successful

        }
        else{
            return response()->json('failure',500); // response if failed
        }

    }

    public function fetch(){
        // Fetching all Asset Assignment
        $id = Auth::id();
        $assetAssignment = AssetAssignment::where('assigned_by',$id)->get();

        if($assetAssignment){
            return response()->json('successful',201);
        }
        else{
            return response()->json('failed',501);
        }

    }

    public function update(Request $request,$id){
        // Updating Asset Assignment Record
        //validating form request
        $validator = Validator::make($request->all(),[
            'asset_id' => 'required',
            'assignment_date' => 'required',
            'status' => 'required',
            'due_date' => 'required',
            'assigned_user_id' => 'required',

        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()],400);  // Response if validation fails
        }
        $created = AssetAssignment::where('id',$id)->update([
            'asset_id' => $request->asset_id,
            'assignment_date' =>  Carbon::parse($request->assignment_date),
            'status' => $request->status,
            'due_date' => Carbon::parse($request->due_date),
            'assigned_user_id' => $request->assigned_user_id,
            'assigned_by' => Auth::id(),
        ]);
        if($created){
            return response()->json('success',201); //Response if successful
        }
        else{
            return response()->json('failure',500); //Response if failed
        }


    }
    public function delete($id){

        $asset_assignment = AssetAssignment::destroy($id);
        if($asset_assignment){

            return response()->json('deleted', 201);
        }
        else{

            return response()->json('something went wrong',500);
        }


    }
}
