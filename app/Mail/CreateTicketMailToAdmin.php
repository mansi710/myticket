<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateTicketMailToAdmin extends Mailable
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
        // $this->user_id = $user_id;
          // dd($ticket)

          $this->ticket = $ticket;

        //   $tn=$ticket->ticket_name;
        //     dump($tn);
        // $this->ticket=$ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.create-ticket-main-to-admin',compact('tn'));

        return $this->view('emails.create-ticket-main-to-admin')->with([
            'ticket_name'=>$this->ticket->ticket_name
        ]);
    }
}
