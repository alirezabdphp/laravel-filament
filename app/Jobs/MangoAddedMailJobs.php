<?php

namespace App\Jobs;

use App\Mail\MangoAddedMail;
use App\Mail\Markdown\Provider\ResendCardInformationToProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MangoAddedMailJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to('alireza2896@gmail.com')->send(new MangoAddedMail());
        } catch (Exception $e) {
            // Exception handling code
            echo "Caught exception: " . $e->getMessage();
        }


    }
}
