<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;
use Illuminate\Contracts\Mail\Mailer;


class AppMailer extends Mailable
{
    use Queueable, SerializesModels;


    public $mailer;
    public $fromAddress = 'mansi.c@int.biztechcs.com';
    public $fromName = 'Support Ticket';
    public $to='gazala.p@int.biztechcs.com';
    public $subject;
    public $view;
    public $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        //
        $this->mailer = $mailer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;
        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";
        $this->view = 'emails.ticket_info';
        $this->data = compact('user', 'ticket');
        return $this->deliver();
    }
    public function sendTicketComments($ticketOwner, $user, Ticket $ticket, $comment)
    {
        
    }
    public function sendTicketStatusNotification($ticketOwner, Ticket $ticket)
    {
        dd($this->to = $ticketOwner->email);
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'emails.ticket_status';
        $this->data = compact('ticketOwner', 'ticket');
        return $this->deliver();
    }
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message){
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
        });
    }
    public function build()
    {
        return $this->view('view.name');
    }
}
