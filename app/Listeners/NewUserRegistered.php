<?php

namespace App\Listeners;


use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewUserRegistered
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {

        $event->user->notify(new \App\Notifications\WelcomeEmail());

       // $data = array('name' =>$event->user->first_name, 'email' =>$event->user->email, 'body' => 'Welcome to our Web Application Site' );

        //Mail::send( 'email.mail',$data,function ($message) use ($data){
          //  $message->to($data['email'])->subject('WELCOME TO OUR WEBSITE');
            //$message->from('noreply@crude_api.com');
        //});

    }
}
