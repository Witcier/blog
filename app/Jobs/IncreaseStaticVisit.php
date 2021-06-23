<?php

namespace App\Jobs;

use App\Enums\EventEnum;
use App\Models\Event\VisitorEvent;
use App\Models\Visit\Visit;
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
        $visit = new VisitorEvent([
            'name' => EventEnum::NAME_VISITOR,
            'scene' => EventEnum::SCENE_MAIN_PAGE,
            'location' => $this->location,
            'ip' => $this->ip,
            'date' => Carbon::now(),
        ]);
        
        $visit->save();
        $pv = Visit::firstOrCreate(
            [
                'scene' => $this->visitorEvent->scene,
                'location' => $this->visitorEvent->location,
            ]
        );
        $pv->pv = $pv->pv + 1;
        $pv->save();
        
        // 判断当前IP今日是否已访问
        if (!VisitorEvent::isVisited($this->location, $this->ip)) {
            return;
        }
        // 更新UV数据
        $uv = UV::firstOrCreate(
            [
                'scene' => $this->visitorEvent->scene,
                'location' => $this->visitorEvent->location,
            ]
        );
        $uv->increment('uv');
        $uv->save();
        
    }
}
