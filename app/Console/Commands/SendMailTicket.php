<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\TicketNotResolvedNotification;
use App\Mail\REMINDERSMAIL;
use App\Mail\reminderTestMail;
use App\Mail\CreateTicketMailToAdmin;
use Mail;
use DateTime;

class SendMailTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notification to admin about reminder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // php artisan reminders:email

        // $DateTime = new DateTime();
        // // dd($DateTime);  
        // $data=$DateTime->modify('-'.$minutes.' minutes');
        // // dd($data);
        // $dateCheck = $DateTime->format('Y-m-d H:i:s');
        // // dd($dateCheck);
        // $data=Ticket::select('id','ticket_name','created_at')->where('created_at', '<', $dateCheck)->get();
        // dd($data->toArray());
        $users = Ticket::query()->with('user')->select('ticket_name','status','id','created_at')->where('status','=','pending')->get();
        foreach($users as $user){
           
            if(Carbon::parse($user->created_at)->diffInHours(Carbon::now()) >= 24){ //Or however your date field on user is called
                //Send an email
                // $user1=User::find(1);
                 dump($user);
       
                //     Mail::to($user1)->send(new reminderTestMail());
            }
        }
        // return 0;
        // nw()->format('Y-m-d')
        //To get Date of Reminder
        // $tickets = Ticket::select('reminder_data')->where('status','=','pending')->get();

        $currentTime = Carbon::now();    
        $currentTime = now()->toDateTimeString();

        // $currentTime = '2022-04-07 13:20:00';
        
        // $tickets=Ticket::query()->with('user')->select('ticket_name','created_at','user_id')
        // ->where('status','=','pending')
        // ->where('created_at','<',$currentTime)->orderby('user_id')->get();

        
        // dd($tickets);
        $tickets=Ticket::query()/*->with('user')*/->select('ticket_name','created_at','user_id')
        ->where('status','=','pending')
        ->where('id', '>=', 262)
        ->where('created_at', '<', $currentTime)
        // ->where("DATE_FORMAT(created_at, '%Y-%m-%d') <= ".$currentTime)
        
        ->orderby('user_id')->get();
      
        dump($tickets->toArray());
        // foreach($tickets as $ticket) {
            
        // $date = Carbon::parse($ticket->created_at)->format('h:i:s');
        // dump($date);
        // if(strtotime($date) < strtotime(date('h:i:s'))) {
        //     // dump($date);
        //     /// do your email code
        //  }
        // }

      
        // $data=[];

        // foreach($tickets as $ticket)
        // {
        //     $data[$ticket->user_id][]=$ticket->toArray();
        // }

        // dump($data);

        // $user=User::find($user_id); 
        // dd($user);
        // $ress = Mail::to($user->email)->send(new REMINDERSMAIL());
        // // dd($ress, 'aa');

        //To send email
      
        // foreach($data as $userId=>$tickets)
        // {
        //     $this->sendEmailToUser($userId,$tickets);
        // }

        // dd($data);
        
    //    dd($userId);
    }

           
    // private function sendEmailToUser(int $userId,$tickets)
    // {
        

    //     // $user=User::find($user_id); 
    //     // dd($user);
    //     // $ress = Mail::to($user->email)->send(new REMINDERSMAIL());
    //     // // dd($ress, 'aa');
        
    //     $user=User::find(1);
       
    //     Mail::to($user)->send(new reminderTestMail($tickets));
        
    //     // Mail::to($tickets->user->email)->send(new CreateTicketMailToAdmin());
    // }
}
