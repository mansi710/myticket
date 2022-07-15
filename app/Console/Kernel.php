<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\TicketsNotResolved;
use App\Console\Commands\SendMailTicket;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        // TicketsNotResolved::class,
        SendMailTicket::class,
      ];

      

    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('TestSendEmail')->everyTwoMinutes();
        // dd($schedule);
        $schedule->command('reminders:email')->daily(24);
        // $schedule->command('reminders:email')->everyTwoMinutes();

        // $schedule->command('inspire')->hourly();


        // $schedule->command('tickets:notresolved-reminder')->daily(24);


        // This code will be scheduled for execution every day at 8:00 am.
        // $schedule->call(function () {
        //     // Get all tickets that are about to expire in the next 2 days.
        //     $tickets = \App\Ticket::where('call_start_time', [now(), now()->addDays(1)])->get();

        //     // Send notifications for those tickets owners.
        //     $tickets->each(function ($ticket) {
        //         $ticket->user->notify(new \App\Notifications\TicketNotResloved($ticket));
        //     });
        // })->dailyAt('08:00');
    
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() 
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
