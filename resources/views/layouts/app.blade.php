<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Сайт про кружки, секции, студии и клубы города Краматорск">
    <meta name="author" content="IT 2.0 Academy">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
          content="кружки, секции, студии, клубы, Краматорск,
          ансамбль, театр, школа, детский, искусства, творчества,
          мастерства, техника, язык, группа, танца, образцовый, песни,
          народный, эстрадного, спортивного, бального, народного,
          изобразительного, танцевальные, спортивные, художественные,
          рукоделие, музыкальные, театральные, образовательные">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Секции, Кружки, Студии</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen"/>
</head>

<body data-spy="scroll" data-target="#ha-header">
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top ha-header-large" id="ha-header">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a onclick="return location.href = '/#home'" class="navbar-brand logo" href="#"></a>
            @if (isset(parse_url(url()->current())['path']))
                <?php $path = parse_url(url()->current())['path'];?>
                @if(dirname($path) ==  "/sections/gallery" || dirname($path) == "/articles")
                    <ul class="nav navbar-nav top1-menu col-xs-6" style="display: none">
                        <li><a class="back" href="#" onclick="javascript:history.back()"></a></li>
                    </ul>
                @endif
            @endif
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <li><a class="nav-link" href="{{ url('/controls') }}">{{ __('Профиль') }}</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right top-menu">
                <li class="a active"><a href="{{url('/#home')}}">Главная</a></li>
                <li class=""><a href="{{url('/#sections')}}">Кружки</a></li>
                <li class=""><a href="{{url('/#schedule')}}">Расписание</a></li>
                <li class=""><a href="{{url('/#news')}}">Новости</a></li>
            </ul>

            @if (isset(parse_url(url()->current())['path']))
                <?php $path = parse_url(url()->current())['path'];?>
                @if (dirname($path) == "/sections/section")
                    <ul class="nav navbar-nav navbar-right top1-menu" style="display: none">
                        <li class="active"><a href="{{url()->current(). '/#about'}}">О нас</a></li>
                        <li><a href="{{url()->current() . '/#schedule'}}">Расписание</a></li>
                        @if(count($news) > 0)
                            <li><a href="{{url()->current() . '/#news'}}">Новости</a></li>
                        @endif
                        @if(count($photos) > 0)
                            <li><a href="{{url()->current() . '/#photos'}}">Галерея</a></li>
                        @endif
                        <li><a href="{{url()->current() . '/#contact'}}">Контакты</a></li>
                    </ul>
                @endif
            @endif
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
<!-- End Fixed navbar -->

<!-- Full Page Image Header Area -->
<div id="home" class="home page-section">
    <div class="header_img">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="spacer"></div>
                <h1><a onclick="return location.href = '/#home'" href="#">Секции, студии, кружки</a></h1>
            </div>
        </div>
    </div>
</div>
<!-- /Full Page Image Header Area -->

<!-- Content. Contains page content -->
@yield('content')
<!-- /.content -->

<!-- Footer -->
<footer>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9 col-sm-12">
                    <p>Copyright &copy; 2018. Все права защищены.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->
<link href="{{ asset('css/front.css') }}" rel="stylesheet">
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
<!-- JavaScript -->
<script src="/js/jquery.min.js"></script>
<script src="/js/nicescroll.min.js"></script>
<!-- jquery nice scroll-->

<script src="/js/isotope.min.js"></script>
<!--Portfolio Filter-->

<script src="/js/waypoints.min.js"></script>
<!--Header Effect-->
<script src="/js/custom_min.js"></script>
<!-- Custom JavaScript  -->

<script src="/js/go_top.js"></script>

<script src="/js/main.js"></script>
<!-- Resource jQuery -->
<script defer type="text/javascript">
    if (document.location.hash) {
        $('a[href^="{{url('/#')}}"]').bind('click.smoothscroll', function (e) {
            e.preventDefault();

            var target = this.hash,
                $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 2000, 'swing', function () {
                window.location.hash = target;
            });
        });

        $(window).scroll(function () {
            var scrollDistance = $(window).scrollTop();
            // Assign active class to nav links while scolling
            $('.page-section').each(function (i) {
                if ($(this).position().top <= scrollDistance + 2) {
                    $('.top-menu li.active').removeClass('active');
                    $('.top-menu li').eq(i).addClass('active');
                }
            });
        }).scroll();
    }
    if (document.location.href != "{{url('/')}}") {
        $('.top-menu li.active').removeClass('active');
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>

<script defer src="/js/jquery.flexslider.js"></script>

<script type="text/javascript">
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>
<!--dynamic navbar script-->
<script defer type="text/javascript">
    function dynNav() {
        var path = window.location.pathname;
        var c = path.lastIndexOf('/');
        var p = path.slice(0, c);
        if (p == "/sections/section" || p == "/sections/gallery" || p == "/articles") {
            $('.a').removeClass('active');
            $('a[href^="{{url()->current(). '/#'}}"]').bind('click.smoothscroll', function (e) {
                e.preventDefault();

                var target = this.hash,
                    $target = $(target);

                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top
                }, 2000, 'swing', function () {
                    window.location.hash = target;
                });
            });

            $(window).scroll(function () {
                var scrollDistance = $(window).scrollTop();
                // Assign active class to nav links while scolling
                $('.page-section1').each(function (i) {
                    if ($(this).position().top <= scrollDistance + 10) {
                        $('.top1-menu li.active').removeClass('active');
                        $('.top1-menu li').eq(i).addClass('active');
                    }
                });
            }).scroll();

            $(".top-menu").css("display", "none");
            $(".top1-menu").css("display", "block");
        }
    }

    dynNav();
</script>

<!--change schedule buttons lables on resize script -->
<script defer type="text/javascript">
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $('[href = "#menu"]').html("Пн");
            $('[href = "#menu1"]').html("Вт");
            $('[href = "#menu2"]').html("Ср");
            $('[href = "#menu3"]').html("Чт");
            $('[href = "#menu4"]').html("Пт");
            $('[href = "#menu5"]').html("Сб");
        }
        else {
            $('[href = "#menu"]').html("Понедельник");
            $('[href = "#menu1"]').html("Вторник");
            $('[href = "#menu2"]').html("Среда");
            $('[href = "#menu3"]').html("Четверг");
            $('[href = "#menu4"]').html("Пятница");
            $('[href = "#menu5"]').html("Суббота");
        }
    });
    $(window).resize();
</script>
</body>

</html>
