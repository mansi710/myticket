<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class reminderTestMail extends Mailable
{
    use Queueable, SerializesModels;


    public $tickets;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tickets)
    {
        //
        dump($tickets);
        $this->tickets = $tickets;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dump($this->tickets);
        return $this->view('emails.reminderTest')->with([
            'ticket_name'=>$this->tickets
        ]);
        // return $this->markdown('emails.reminderTest');
        // return $this->markdown('emails.reminderTest')->with('tickets'.$this->tickets);
    }

   
}
