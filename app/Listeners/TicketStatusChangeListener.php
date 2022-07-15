<?php

namespace App\Listeners;

use App\Events\TicketStatusChangeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\Ticket;
use Mail;
class TicketStatusChangeListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(TicketStatusChangeEvent $event)
    {
        //
        
        $user = User::find($event->user_id)->toArray();
        Mail::send('emails.ticket_status', $user, function($message) use ($user) {
            
            $message->to($user);
            dump($message);
            $message->subject('Event Testing');
            dump($message);
        });
        
        
    }
}
