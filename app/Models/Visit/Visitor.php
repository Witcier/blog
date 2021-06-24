<?php

namespace App\Models\Visit;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'statistic_visitor';

    protected $fillable = [
        'name', 'scene', 'location', 'ip', 'content', 'date',
    ];

    protected $casts = [
        'content' => 'json'
    ];

    protected $dates = [
        'date'
    ];

    public static function isVisited($location, $ip)
    {
        $visit = static::query()
            ->where('location', '=', $location)
            ->where('ip', '=', $ip)
            ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->first();

        if ($visit) {
            return false;
        }

        return true;
    }
}
