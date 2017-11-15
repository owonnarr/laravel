<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Test;

class AuthLogListener
{
    public function onLoginUser($event)
    {
        
        Test::create([
            'name' => $event->user->name,
            'status' => 'login',
        ]);
    }
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
    
    public function subscribe($events)
    {
        $events->listen(
        'Illuminate\Auth\Events\Login',
        'App\Listeners\AuthLogListener@onLoginUser');
    }
}
