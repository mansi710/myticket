<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class REMINDERSMAIL extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tickets)
    {
        //
        dump($tickets);
        $this->tickets=$tickets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.CREATE_REMINDER_MAIL')->with('tickets'.$this->tickets);
        // return $this->view('emails.CREATE_REMINDER_MAIL');
    }
}
