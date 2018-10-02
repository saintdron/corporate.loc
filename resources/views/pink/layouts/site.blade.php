<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie" dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie" dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<![endif]-->

<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<!-- START HEAD -->
<head>

    <meta charset="UTF-8"/>
    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes"/>

    <meta name="description" content="{{ (isset($meta_desc)) ? $meta_desc : '' }}">
    <meta name="keywords" content="{{ (isset($keywords)) ? $keywords : '' }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or 'Pink' }}</title>

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('settings.theme')) }}/images/favicon.ico"/>
    <link rel="icon" type="image/x-icon" href="{{ asset(config('settings.theme')) }}/images/favicon.ico"/>
    <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
    <!-- For iPad3 with retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ asset(config('settings.theme')) }}/apple-touch-icon-144x.png"/>
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{ asset(config('settings.theme')) }}/apple-touch-icon-114x.png"/>
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset(config('settings.theme')) }}/apple-touch-icon-72x.png"/>
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset(config('settings.theme')) }}/apple-touch-icon-57x.png"/>
    <!-- [favicon] end -->

    <!-- CSSs -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset(config('settings.theme')) }}/css/reset.css"/>
    <!-- RESET STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset(config('settings.theme')) }}/style.css"/>
    <!-- MAIN THEME STYLESHEET -->
    <link rel="stylesheet" id="max-width-1024-css" href="{{ asset(config('settings.theme')) }}/css/max-width-1024.css"
          type="text/css" media="screen and (max-width: 1240px)"/>
    <link rel="stylesheet" id="max-width-768-css" href="{{ asset(config('settings.theme')) }}/css/max-width-768.css" type="text/css"
          media="screen and (max-width: 987px)"/>
    <link rel="stylesheet" id="max-width-480-css" href="{{ asset(config('settings.theme')) }}/css/max-width-480.css" type="text/css"
          media="screen and (max-width: 480px)"/>
    <link rel="stylesheet" id="max-width-320-css" href="{{ asset(config('settings.theme')) }}/css/max-width-320.css" type="text/css"
          media="screen and (max-width: 320px)"/>

    <!-- CSSs Plugin -->
    <link rel="stylesheet" id="thickbox-css" href="{{ asset(config('settings.theme')) }}/css/thickbox.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" id="styles-minified-css" href="{{ asset(config('settings.theme')) }}/css/style-minifield.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" id="buttons" href="{{ asset(config('settings.theme')) }}/css/buttons.css" type="text/css" media="all"/>
    <link rel="stylesheet" id="cache-custom-css" href="{{ asset(config('settings.theme')) }}/css/cache-custom.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" id="custom-css" href="{{ asset(config('settings.theme')) }}/css/custom.css" type="text/css" media="all"/>

    <!-- FONTs -->
    <link rel="stylesheet" id="google-fonts-css"
          href="http://fonts.googleapis.com/css?family=Oswald%7CDroid+Sans%7CPlayfair+Display%7COpen+Sans+Condensed%3A300%7CRoboto Slab%7CShadows+Into+Light%7CAbel%7CDamion%7CMontez&amp;ver=3.4.2"
          type="text/css" media="all"/>
    <link rel='stylesheet' href='{{ asset(config('settings.theme')) }}/css/font-awesome.css' type='text/css' media='all'/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab%3A400%7CArimo%3A400%2C400italic%2C700" media="all">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" media="all">

    <!-- JAVASCRIPTs -->
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/comment-reply.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.quicksand.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.tipsy.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.cycle.min.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.anythingslider.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.eislideshow.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.easing.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.aw-showcase.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/layerslider.kreaturamedia.jquery-min.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/shortcodes.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.colorbox-min.js"></script> <!-- nav -->
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.tweetable.js"></script>

    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/myscripts.js"></script>

</head>
<!-- END HEAD -->

<!-- START BODY -->
<body class="no_js responsive {{ (Route::currentRouteName() === 'home'
                                || Route::currentRouteName() === 'login'
                                || Route::currentRouteName() === 'portfolios.show') ? 'page-template-home-php' : '' }} stretched">

<!-- START BG SHADOW -->
<div class="bg-shadow">

    <!-- START WRAPPER -->
    <div id="wrapper" class="group">

        <!-- START HEADER -->
        <div id="header" class="group">

            <div class="group inner">
                <!-- START LOGO -->
                <div id="logo" class="group">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset(config('settings.theme')) }}/images/tp-circle2.png" title="Tproger"
                             alt="Tproger"/>
                        <span class="brand_name">Tproger</span>
                    </a>
                </div>
                <!-- END LOGO -->

                <div id="sidebar-header" class="group">
                    <div class="widget-first widget yit_text_quote">
                        <blockquote class="text-quote-quote">
                            &#8220;Не волнуйтесь, если что-то не работает. Если бы всё работало, вас бы уволили.&#8221;
                        </blockquote>
                        <cite class="text-quote-author">Закон Мошера</cite>
                    </div>
                </div>
                <div class="clearer"></div>
                <hr/>

                <!-- START MAIN NAVIGATION -->
                @yield('navigation')
                <!-- END MAIN NAVIGATION -->

                {{--Кнопка Login--}}
                @if(Route::currentRouteName() === 'home')
                {!! Form::open(['url' => route('login'), 'method' => 'get']) !!}
                {!! Form::button('<i class="icon-signin"></i> Войти в админку', ['class' => 'btn btn-oliva-3 btn-admin-enter', 'title' => 'Войти в панель администратора', 'type' => 'submit']) !!}
                {!! Form::close() !!}
                @endif

                <div id="header-shadow"></div>
                <div id="menu-shadow"></div>
            </div>

        </div>
        <!-- END HEADER -->

        <!-- START SLIDER -->
        @yield('slider')
        <!-- END SLIDER -->

        <!-- START STASUS -->
        <div class="wrap_status">
            <div class="status"></div>
        </div>
        <!-- END STASUS -->

        @if(Route::currentRouteName() === 'portfolios.index')
        <!-- START PORTFOLIO META -->
        <div id="page-meta">
            <div class="inner group">
                <h3>Добро пожаловать на страничку портфолио</h3>
                <h4>...и я надеюсь, что вам понравятся мои работы</h4>
            </div>
        </div>
        <!-- END PORTFOLIO META -->
        @endif

        @if(Route::currentRouteName() === 'contacts')
        <!-- START CONTACTS META -->
        <div id="page-meta">
            <div class="inner group">
                <h3>...Скажи ПРИВЕТ! :)</h3>
                <h4>Свяжитесь с разработчиками сайта</h4>
            </div>
        </div>
        <!-- END CONTACTS META -->
        @endif

        <!-- START PRIMARY -->
        <div id="primary" class="sidebar-{{ isset($bar) ? $bar : 'no' }}">
            <div class="inner group">
                <!-- START CONTENT -->
                @yield('content')
                <!-- END CONTENT -->
                <!-- START SIDEBAR -->
                @yield('sidebar')
                <!-- END SIDEBAR -->
                <!-- START EXTRA CONTENT -->
                <!-- END EXTRA CONTENT -->
            </div>
        </div>
        <!-- END PRIMARY -->
    </div>
    <!-- END WRAPPER -->
</div>
<!-- END BG SHADOW -->

<!-- START COPYRIGHT -->
@yield('footer');
<!-- END COPYRIGHT -->

{{--Стрелка вверх--}}
<a href="#" class="scrollup">Наверх</a>

<script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.custom.js"></script>
<script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/contact.js"></script>
<script type="text/javascript" src="{{ asset(config('settings.theme')) }}/js/jquery.mobilemenu.js"></script>

</body>
<!-- END BODY -->
</html>