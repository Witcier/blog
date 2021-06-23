<?php

namespace App\Jobs;

use App\Models\Event\VisitorEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncreaseStaticVisit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $location;
    protected $ip;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($location, $ip)
    {
        $this->location = $location;
        $this->ip = $ip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 判断当前IP今日是否已访问
        if (!VisitorEvent::isVisited($this->location, $this->ip)) {
            return;
        }
    }
}
