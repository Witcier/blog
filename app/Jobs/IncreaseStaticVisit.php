<?php

namespace App\Jobs;

use App\Enums\EventEnum;
use App\Models\Visit\Visit;
use App\Models\Visit\Visitor;
use Carbon\Carbon;
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
        $visitor = new Visitor([
            'name' => EventEnum::NAME_VISITOR,
            'scene' => EventEnum::SCENE_MAIN_PAGE,
            'location' => $this->location,
            'ip' => $this->ip,
            'date' => Carbon::now(),
        ]);
        
        $visitor->save();
        $visit = Visit::firstOrCreate(
            [
                'scene' => $visitor->scene,
                'location' => $this->location,
            ]
        );
        $visit->increment('pv');
        
        // 判断当前IP今日是否已访问
        if (Visitor::isVisited($this->location, $this->ip)) {
            // 更新UV数据
            $visit->increment('uv');
        }
    }
}
