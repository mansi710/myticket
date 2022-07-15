<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TestSendEmail;

class TestQueueEmails extends Controller
{
    //
    public function sendTestEmails()
    {
        $emailJobs = new TestSendEmail();
        // dd($emailJobs);
        $this->dispatch($emailJobs);
    }

    public function send_mail(Request $request)
    {
        $details = [
            'subject' => 'Test Notification'
        ];
        
        $job = (new \App\Jobs\SendQueueEmail($details))
                ->delay(now()->addSeconds(2)); 
        dispatch($job);
        echo "Mail send successfully !!";
    }
}
