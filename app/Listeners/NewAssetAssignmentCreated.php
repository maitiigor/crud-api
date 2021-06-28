<?php

namespace App\Listeners;

use App\Events\AssetAssignmentCreated;
use App\Models\AssetAssignment;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewAssetAssignmentCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
       public $is_due;
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AssetAssignmentCreated  $event
     * @return void
     */
    public function handle(AssetAssignmentCreated $event)
    {

       $vendor = AssetAssignment::with('vendor')->first();


        $vendor->vendor->name;
        $email= Auth::user()->email;


        // Passing mail data to the User
        $data = array(
            'vendor' => $vendor->vendor->name,
            'email' => $email,
            );

        Mail::send( 'email.mail_asset_assignment',$data,function ($message) use ($data){
          $message->to($data['email'])->subject('You have added an Assignment to a vendor');
          $message->from('noreply@crude_api.com');
        });
    }
}
