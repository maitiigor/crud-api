<?php

namespace App\Listeners;

use App\Events\AssetRegistered;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class NewAssetRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AssetRegistered  $event
     * @return void
     */
    public function handle(AssetRegistered $event)
    {
        $email = Auth::user()->email;
        //$id=Auth::id();
        //$email = User::where('id',$id)->get('email');

         $data = array(
             'type' =>$event->asset->type,
             'serial' =>$event->asset->serial_number,
             'description' => $event->asset->description,
             'fixed_or_movable' => $event->asset->purchase_date,
             'status' => $event->asset->purcahse_price,
             'location' => $event->asset->location,
             'degradation in years' => $event->asset->degradation_in_years,
             'warranty_expiry' => $event->asset->warranty_expiry_date,
             'email' => $email,

         );

        Mail::send( 'email.mail',$data,function ($message) use ($data){
        $message->to($data['email'])->subject('Asset created successfully');
        $message->from('noreply@crude_api.com');
        });


    }
}
