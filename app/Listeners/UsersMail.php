<?php

namespace App\Listeners;

use App\Mail\UserMails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsersMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
      //  Mail::to($event->data->email)->send(new UserMails($event->data));

    }
}
