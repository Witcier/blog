@extends('tpl-page')

{{--页面特定的Header信息--}}
@include('sample.header')

{{--页面Content--}}
@section('content')
    <div>
        <ul id="treeDemo" class="ztree"></ul>
    </div>
@endsection
