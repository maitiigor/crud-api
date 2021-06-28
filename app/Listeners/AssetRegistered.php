<?php

namespace App\Listeners;

use App\Events\AssetRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssetRegistered
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
        //
    }
}
