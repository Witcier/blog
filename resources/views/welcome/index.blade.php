@extends('tpl-page')

@include('welcome.header')

@section('content')
    <div class="welcome-container">
        <div class="welcome-center-container">
            <div class="outer-circle">
                <div class="inner-circle">
                </div>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="welcome-profile-container">
                <p class="user-profile-slogin">{{ config('user_slogin','Coding For Fun，代码改变世界') }}</p>
            </div>

            @isset($menus)
                <div class="welcome-nav-menu-container">
                    @foreach($menus as $menu)
                        <a class="welcome-nav-menu" href="{{ url("/".$menu->path) }}">{{ $menu->name }}</a>
                    @endforeach
                </div>
            @endisset
        </div>

    </div>

@endsection
