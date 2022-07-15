<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use App\Mail\reminderEmail;
// use App\Commands\SendMailTicket;

class reminderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tickets;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->tickets=$tickets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reminder')/*->with('tickets',$this->tickets)*/;
    }
}
