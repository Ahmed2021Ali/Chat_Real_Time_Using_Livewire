<?php

namespace App\Jobs;

use App\Events\RegisterEven;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->data as $data)
        {
            event(new RegisterEven($data));
        }
    }
}
