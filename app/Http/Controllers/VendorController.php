<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Events\VendorRegistered;

class VendorController extends Controller
{
    //
    public function _construct(){
        $this->middleware('auth:api');
    }
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json((['error' => $validator->errors()]),400);
        }
        $vendor = Vendor::create([
            'name' => $request->name,
            'category' => $request->category,

        ]);
        if($vendor){
            event(new VendorRegistered($vendor));
            return response()->json('created',201);
        }
        else{
            return response()->json('error',500);
        }

    }

    public function fetch(){

        $vendors = Vendor::all();

        return response()->json($vendors,201);
    }
    public function update(Request $request,$id){
        $update = Vendor::whereId($id)->update($request->all());

        return response()->json('updated',201);
    }
    public function delete($id){
        $delete = Vendor::whereId($id)->delete();

        return response()->json('deleted',201);
    }

}
