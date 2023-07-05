<?php

namespace App\Jobs;

use App\Traits\MailTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MailJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, MailTrait;
    /**
     * Create a new job instance.
     */

    public $request;
    public function __construct($request)
    {
        //
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $this->sendReset($this->request);
    }
}
