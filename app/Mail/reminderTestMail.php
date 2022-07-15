<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;

class reminderTestMail extends Mailable
{
    use Queueable, SerializesModels;


    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        //
        // dd($ticket);
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd($this->ticket);
       
        return $this->view('emails.reminderTest')->with([
    'ticket_name'=>$this->ticket->ticket_name
        ]);
    }
}

