<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'admin_config';

    protected $fillable = [
        'name', 'value', 'description',
    ];

    public static function loadAllConfig()
    {
        foreach (static::all(['name', 'value']) as $config) {
            config([$config['name'] => $config['value']]);
        }
    }
}
