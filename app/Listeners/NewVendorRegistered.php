<?php

namespace App\Listeners;

use App\Events\VendorRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class NewVendorRegistered
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
     * @param  VendorRegistered  $event
     * @return void
     */
    public function handle(VendorRegistered $event)
    {
        $email = Auth::user()->email;
        $data = array('name' =>$event->vendor->name, 'category' =>$event->vendor->category,'email' => $email, 'body' => 'New vendor has been created successfully' );

        Mail::send( 'email.mail_vendor',$data,function ($message) use ($data){
         $message->to($data['email'])->subject('A vendor as successfully been added by you');
        $message->from('noreply@crude_api.com');
        });
    }
}
