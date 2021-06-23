<?php

namespace App\Models\Visit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $table = 'statistic_visit';

    protected $fillable = [
        'scene', 'location',
    ];
}
