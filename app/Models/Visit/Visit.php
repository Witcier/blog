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

    public const LOCATION_WELCOME = "welcome";
    public const LOCATION_BLOG = "blog";
    public const LOCATION_WIKI = "wiki";
    public const LOCATION_NAVIGATE = "navigation";
    public const LOCATION_XMIND = "xmind";
    public const LOCATION_GUEST_BOOK = "guest_book";
    public const LOCATION_ABOUT = "about";

    public static $locationMap = [
        self::LOCATION_WELCOME => '主页',
        self::LOCATION_BLOG => '博客',
        self::LOCATION_WIKI => '知识库',
        self::LOCATION_NAVIGATE => '导航站',
        self::LOCATION_XMIND => '思维导图',
        self::LOCATION_GUEST_BOOK => '留言板',
        self::LOCATION_ABOUT => '关注我',
    ];
}
