@extends('tpl-page')

{{--页面特定的Header信息--}}
@include('about.header')

{{--页面Content--}}
@section('content')

    <div class="about-container">
        <div class="fill-and-overflow-auto">
            <div class="col-sm-10 col-lg-10 col-sm-offset-1 about-main-container">
                <div class="col-sm-9 about-container-left">

                    <div class="about-me">
                        <p class="about-item-title">关于我</p>
                        <div class="markdown-body editormd-preview-theme-dark bout-me-editormd" id="about-me-editormd-html-view">
                            <textarea style="display:none;" name="test-editormd-markdown-doc">###Hello world!</textarea>
                        </div>
                    </div>

                    <div class="about-site">
                        <p class="about-item-title">关于本站</p>
                        <div class="markdown-body editormd-preview-theme-dark about-site-editormd" id="about-site-editormd-html-view">
                            <textarea style="display:none;" name="test-editormd-markdown-doc">###Hello world!</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-lg-3">
                    <div class="user-profile ">
                        <img class="about-wechat-img" src="{{ config('user_wechat','/static-common/img/logo.png') }}">
                        <p class="about-contact-me-text">微信扫码联系我</p>
                        <div class="about-contact-me-more">
                            <div class="about-contact-me-more-item">
                                <a href="{{ config('user_github','') }}" target="_blank" title="GitHub">
                                    <img class="about-contact-me-more-item-icon" src="{{ asset('/static-common/img/github.png') }}">
                                </a>
                            </div>
                            <div class="about-contact-me-more-item">
                                <a href="{{ "mailto:".config('user_email','') }}" title="Email">
                                    <img class="about-contact-me-more-item-icon" src="{{ asset('/static-common/img/email.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                    @isset($visits)
                        <div class="access-statistic-detail">
                            <p class="about-item-title access-statistic-detail-title">访问统计</p>
                            @foreach($visits as $visit)
                                @if(empty($visit))
                                    @continue
                                @endif
                                <div class="access-statistic-item">
                                    <p class="access-statistic-item-name">{{ App\Models\Visit\Visit::$locationMap[$visit->location] }}</p>
                                    <div class="access-statistic-item-pv">
                                        <p class="access-statistic-name">访问总次数</p>
                                        <p class="access-statistic-pv">{{ $visit->pv }}</p>
                                    </div>
                                    <div class="access-statistic-item-uv">
                                        <p class="access-statistic-name">访问总人数</p>
                                        <p class="access-statistic-uv">{{ $visit->uv }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endisset
                </div>
            </div>
        </div>

        <div class="about-footer-container">
            @include('tpl-footer')
        </div>
    </div>

    <script type="text/javascript">

        editormd.markdownToHTML("about-me-editormd-html-view", {
            markdown: window.aboutMe,
            htmlDecode: "style,script,iframe",
            tocm: true,
            emoji: true,
            taskList: true,
            tex: true,
        });

        editormd.markdownToHTML("about-site-editormd-html-view", {
            markdown: window.aboutSite,
            htmlDecode: "style,script,iframe",
            tocm: true,
            emoji: true,
            taskList: true,
            tex: true,
        });
    </script>

@endsection
