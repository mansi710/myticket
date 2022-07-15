<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
class WhenTicketCreatedByUser extends Notification implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $ticket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        // $this->ticket=$ticket;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        // dump($notifiable);
     
        return (new MailMessage)
                    ->line('Ticket Created By User notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our Ticket System!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // dd($notifiable);
        // return [
        //     //
        //     'data'=>'We have a new notification '.$this->ticket->ticket_name ."Added By" .auth()->user()->name
        // ];

        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ];
    }

    public function toDatabase($notifiable)
    {
        dd($notifiable);
        return [
            //
            'user'=>$notifiable,
            'message'=>'ticket created by user successfully'
     ];
    }    
}
