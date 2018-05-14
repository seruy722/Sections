<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="business, corporate, corporate website, creative, html5, marketing, multipurpose, responsive, site templates">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Кружки, секции</title>
    <link rel="stylesheet" href="/css/front.css">
</head>

<body data-spy="scroll" data-target="#ha-header">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top ha-header-large" id="ha-header">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand logo" href="index.html">Project name</a>
            </div>
            <div class="navbar-collapse collapse ">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#home">home</a></li>
                    <li><a href="#sections">Кружки</a></li>
                    <li><a href="#schedule">Расписание</a></li>
                    <li><a href="#news">Новости</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    <!-- End Fixed navbar -->

    <!-- Full Page Image Header Area -->
    <div id="home" class="home">
        <div class="header_img">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="spacer"></div>
                    <h1>Секции, студии, кружки</h1>
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
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9 col-sm-12">
                    <p>Copyright &copy; 2018 Coyier. All rights reserved.</p>
                </div>
                <div class="col-xs-12 col-md-3 col-sm-12">
                    <ul class=" footer_social clearfix">
                        <li><a href="#"><img src="./images/favicon.png" alt=""></a></li>
                        <li><a href="#"><img src="./images/favicon.png" alt=""></a></li>
                        <li><a href="#"><img src="./images/favicon.png" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- /Footer -->

    <!-- JavaScript -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <script src="/js/nicescroll.min.js"></script>
    <!-- jquery nice scroll-->

    <script src="/js/isotope.min.js"></script>
    <!--Portfolio Filter-->

    <script src="/js/waypoints.min.js"></script>
    <!--Header Effect-->
    <script src="/js/custom_min.js"></script>
    <!-- Custom JavaScript  -->

    <script src="/js/main.js"></script>
    <!-- Resource jQuery -->


</body>

</html>
