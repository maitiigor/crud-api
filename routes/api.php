<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
],function ($router){

    //User authentication Routes
    Route::post('/login','AuthController@login')->name('login');
    Route::post('/register','AuthController@register')->name('register');
    Route::get('/logout','AuthController@logout')->name('logout');
    Route::post('/refresh','AuthControlller@refresh')->name('refresh');
    Route::get('/me','AuthController@me')->name('me');

});


Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
],function ($router){

    //User Routes
    Route::patch('/update_user/{id}','UserController@updateUserDetails')->name('user.update');
    Route::get('/fetch_user','UserController@fetchUser')->name('view.user');
    Route::delete('/delete_user/{id}','UserController@deleteUser')->name('delete.user');

    //Assets Routes
    Route::post('/create_asset','AssetController@create')->name('asset.create');
    Route::get('/asset_fetch/','AssetController@fetch')->name('asset.fetch');
    Route::patch('asset_update/{id}', 'AssetController@update')->name('asset.update');
    Route::delete('asset_delete/{id}', 'AssetController@delete')->name('asset.delete');

    // Vendor routes
    Route::post('/create_vendor','VendorController@create')->name('vendor.create');
    Route::get('/vendor_fetch/','VendorController@fetch')->name('vendor.fetch');
    Route::patch('vendor_update/{id}', 'VendorController@update')->name('vendor.update');
    Route::delete('vendor_delete/{id}', 'VendorController@delete')->name('vendor.delete');
        //Verify Registered User;
        // verify registered users
        //Asset Assignment Route
    Route::post('create_asset_assignment','AssetAssignmentController@create')->name('asset.assignment.create');
    Route::get('asset_assignment_fetch','AssetAssignmentController@fetch')->name('asset.assignment.fetch');
    Route::patch('asset_assignment_update/{id}','AssetAssignmentController@update')->name('asset.assignment.update');
    Route::delete('asset_assignment_delete/{id}','AssetAssignmentController@delete')->name('asset.assignment.delete');
});
