<?php

namespace App\Http\Controllers;

use App\Events\AssetRegistered;
use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Validator;
use Carbon;

class AssetController extends Controller
{
    //
    public function _construct(){
        $this->middleware('auth:api');
}
    public function create(Request $request){
        // creating new asset
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'serial_number' => 'required',
            'description' => 'required',
            'fixed_or_movable' => 'required',
            'picture_path' => 'required|image|mimes:jpg,png',
            'purchase_date' => 'required',
            'purchase_price' => 'required',
            'start_use_date' => 'required',
            'degradation_in_years' => 'required',
            'current_value_in_naira' => 'required',
            'location' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json((['error' => $validator->errors()]),400);
        }
        $imageName = $request->picture_path->getClientOriginalName().'.'.$request->picture_path->extension();
        $request->picture_path->move(public_path('images'),$imageName);
        $asset=Asset::create([
                'type' => $request->type,
                'serial_number' => $request->serial_number,
                'description' => $request->description,
                'fixed_or_movable' => $request->fixed_or_movable,
                'purchase_date' => Carbon\Carbon::parse($request->purchase_date),
                'purchase_expiry_date' =>  Carbon\Carbon::parse($request->purchase_expiry_date),
                'picture_path' => $imageName,
                'purchase_price' => $request->purchase_price,
                'start_use_date' =>  Carbon\Carbon::parse($request->start_use_date_),
                'degradation_in_years' => $request->degradation_in_years,
                'warranty_expiry_date' => $request->warranty_expiry_date,
                'current_value_in_naira' => $request->current_value_in_naira,
                'location' => $request->location,

        ]);
        if ($asset){
            event(new AssetRegistered($asset));

            return response()->json(['message' => 'successful'],201);
        }
        else{
            return response()->json(['message' => 'something went wrong'],500);
        }
    }

    public function update($id,Request $request){
        // updating asset
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'serial_number' => 'required',
            'description' => 'required',
            'fixed_or_movable' => 'required',
            'picture_path' => 'required|image|mimes:jpg,png',
            'purchase_date' => 'required',
            'purchase_price' => 'required',
            'start_use_date' => 'required',
            'degradation_in_years' => 'required',
            'current_value_in_naira' => 'required',
            'location' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json((['error' => $validator->errors()]),400);
        }

        $imageName = $request->picture_path->getClientOriginalName().'.'.$request->picture_path->extension();
        $request->picture_path->move(public_path('images'),$imageName);
        $update = Asset::where('id',$id)->update([

            'type' => $request->type,
            'serial_number' => $request->serial_number,
            'description' => $request->description,
            'fixed_or_movable' => $request->fixed_or_movable,
            'purchase_date' => Carbon\Carbon::parse($request->purchase_date),
            'purchase_expiry_date' =>  Carbon\Carbon::parse($request->purchase_expiry_date),
            'picture_path' => $imageName,
            'purchase_price' => $request->purchase_price,
            'start_use_date' =>  Carbon\Carbon::parse($request->start_use_date_),
            'degradation_in_years' => $request->degradation_in_years,
            'current_value_in_naira' => $request->current_value_in_naira,
            'warranty_expiry_date' => $request->warranty_expiry_date,
            'location' => $request->location,

        ]);

        if ($update){
            return response()->json(['message' => 'successful'],201);
        }
        else{
            return response()->json(['message' => 'something went wrong'],500);
        }
    }
    public function fetch(){
        // fetching all assets
        $fetch = Asset::all();


        if($fetch){

            return response()->json(['fetch' => $fetch],201);
        }
        else{
            response()->json($fetch,500);
        }

    }

    public function delete($id){
        // Deleting asset
        $delete = Asset::where('id',$id)->delete();
        if($delete){
            return response()->json(['message' => 'successful'],201);
        }
        else{
            return response()->json(['message' => 'Something went wrong']);
        }

    }
}
