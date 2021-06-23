<?php

namespace App\Enums;

/**
 * 事件统计表，仅统计IP，粗略统计，非准确数据
 */
class EventEnum
{
    /*** 事件名称，访问记录 ***/
    public const NAME_VISITOR = "visitor";

    /**scene值*/
    public const SCENE_MAIN_PAGE = "main_page";

    /**location 值*/
    public const LOCATION_WELCOME = "welcome";
    public const LOCATION_BLOG = "blog";
    public const LOCATION_WIKI = "wiki";
    public const LOCATION_NAVIGATE = "navigate";
    public const LOCATION_XMIND = "xmind";
    public const LOCATION_GUEST_BOOK = "guest_book";
    public const LOCATION_ABOUT = "about";
}