<style>
    .files > li {
        float: left;
        width: 150px;
        border: 1px solid #eee;
        margin-bottom: 10px;
        margin-right: 10px;
        position: relative;
    }
    .files>li>.file-select {
        position: absolute;
        top: -4px;
        left: -1px;
    }
    .file-icon {
        text-align: center;
        font-size: 65px;
        color: #666;
        display: block;
        height: 100px;
    }
    .file-info {
        text-align: center;
        padding: 10px;
        background: #f4f4f4;
    }
    .file-name {
        font-weight: bold;
        color: #666;
        display: block;
        overflow: hidden !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
    }
    .file-size {
        color: #999;
        font-size: 12px;
        display: block;
    }
    .files {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .file-icon.has-img {
        padding: 0;
    }
    .file-icon.has-img>img {
         max-width: 100%;
         height: auto;
         max-height: 92px;
     }
</style>

<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
        <div class="box box-primary">

            @include('admin.media._toolbar')
            <!-- /.box-body -->
            <div class="box-footer file-manager-box">
                @include('admin.media._breadcrumb')
                <ul class="files clearfix">

                    @if (empty($list))
                        <li style="height: 200px;border: none;"></li>
                    @else
                        @foreach($list as $item)
                        <li>
                            <span class="file-select">
                                <input type="checkbox" value="{{ $item['name'] }}"/>
                            </span>

                            {!! $item['preview'] !!}

                            <div class="file-info">
                                <a @if(!$item['isDir'])target="_blank"@endif href="{{ $item['link'] }}" class="file-name" title="{{ $item['name'] }}">
                                    {{ $item['icon'] }} {{ basename($item['name']) }}
                                </a>
                                <span class="file-size">
                                  {{ $item['size'] }}&nbsp;

                                    <div class="btn-group btn-group-xs pull-right">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" class="file-rename" data-toggle="modal" data-target="#moveModal" data-name="{{ $item['name'] }}">Rename & Move</a></li>
                                            <li><a href="#" class="file-delete" data-path="{{ $item['name'] }}">Delete</a></li>
                                            @unless($item['isDir'])
                                            <li><a target="_blank" href="{{ $item['download'] }}">Download</a></li>
                                            @endunless
                                            <li class="divider"></li>
                                            <li><a href="#" data-toggle="modal" data-target="#urlModal" data-url="{{ $item['url'] }}">Url</a></li>
                                        </ul>
                                    </div>
                                </span>
                            </div>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <!-- /.box-footer -->
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>

@include('admin.media._modal')

@include('admin.media._javascript')
