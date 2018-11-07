<?php

namespace App\Listeners;

use App\Events\ReplyCountEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyCountEventListener
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
     * @param  ReplyCountEvent  $event
     * @return void
     */
    public function handle(ReplyCountEvent $event)
    {
        //
    }
}
