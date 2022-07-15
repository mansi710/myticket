<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\Ticket;
use Carbon\Carbon;
use App\Notifications\TicketNotReslovedNotification;


class TicketsNotResolved extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:notresolved-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder Admin For Tickets Which Are Not Resloved Within 1 Day.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;

        $tickets = Ticket::where('reminder_data', '>', Carbon::now()->toDateTimeString())
        ->where('notified', 0)
        ->get();

        dd($tickets);
 
        foreach ($tickets as $ticket){
            $ticket->user->notify(new TicketNotReslovedNotification());
            $ticket->notified = 1;
            $ticket->save();
        }
    }
}
