@extends('layouts.app')

@section('content')
    <!-- About -->
    <div id="about" class="about ha-waypoint page-section1" data-animate-down="ha-header-small"
         data-animate-up="ha-header-large">
        <div class="container">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="container TitleSection">
                    <header class="page-head">
                        <h2>О нас</h2>
                    </header>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <div class="log"><img src="/images/{{$users->img_logo}}" alt="filter"></div>
                        <p style="text-align: justify;">{{$users->info}}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->

    <!-- Schedule -->
    <div id="schedule" class="schedule page-section1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h2>Расписание</h2>
                        </header>
                    </div>
                    <div class="container">
                        <ul class="nav nav-justified nav-pills">
                            <li class="active noround"><a data-toggle="pill" href="#menu">Понедельник</a></li>
                            <li class="noround"><a data-toggle="pill" href="#menu1">Вторник</a></li>
                            <li class="noround"><a data-toggle="pill" href="#menu2">Среда</a></li>
                            <li class="noround"><a data-toggle="pill" href="#menu3">Четверг</a></li>
                            <li class="noround"><a data-toggle="pill" href="#menu4">Пятница</a></li>
                            <li class="noround"><a data-toggle="pill" href="#menu5">Суббота</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="menu" class="tab-pane fade in active">
                                <table class="table table-bordered table-striped table-hover">
                                    <div class="container">
                                        <thead>
                                        <tr class="table-head">
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($monday as $b)
                                            <tr>
                                                <td>{{$b->event_start}}</td>
                                                <td>{{$b->event_end}}</td>
                                                <td>{{$b->event_name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                            <div id="menu1" class="tab-pane fade">
                                <table class="table table-bordered table-striped table-hover">
                                    <div class="container">
                                        <thead>
                                        <tr class="table-head">
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tuesday as $b)
                                            <tr>
                                                <td>{{$b->event_start}}</td>
                                                <td>{{$b->event_end}}</td>
                                                <td>{{$b->event_name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                            <div id="menu2" class="tab-pane fade">
                                <table class="table table-bordered table-striped table-hover">
                                    <div class="container">
                                        <thead>
                                        <tr class="table-head">
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wednesday as $b)
                                            <tr>
                                                <td>{{$b->event_start}}</td>
                                                <td>{{$b->event_end}}</td>
                                                <td>{{$b->event_name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                            <div id="menu3" class="tab-pane fade">
                                <table class="table table-bordered table-striped table-hover">
                                    <div class="container">
                                        <thead>
                                        <tr class="table-head">
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($thursday as $b)
                                            <tr>
                                                <td>{{$b->event_start}}</td>
                                                <td>{{$b->event_end}}</td>
                                                <td>{{$b->event_name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                            <div id="menu4" class="tab-pane fade">
                                <table class="table table-bordered table-striped table-hover">
                                    <div class="container">
                                        <thead>
                                        <tr class="table-head">
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($friday as $b)
                                            <tr>
                                                <td>{{$b->event_start}}</td>
                                                <td>{{$b->event_end}}</td>
                                                <td>{{$b->event_name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                            <div id="menu5" class="tab-pane fade">
                                <table class="table table-bordered table-striped table-hover">
                                    <div class="container">
                                        <thead>
                                        <tr class="table-head">
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($saturday as $b)
                                            <tr>
                                                <td>{{$b->event_start}}</td>
                                                <td>{{$b->event_end}}</td>
                                                <td>{{$b->event_name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Schedule -->

    @if(count($news) > 0)
        <!-- News-->
        <div id="news" class="news page-section1">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <div class=" container TitleSection">
                            <header class="page-head">
                                <h2>Новости</h2>
                            </header>
                        </div>
                        <div class="row">
                            <div class="imgSwitch">
                                <div class="row">
                                    @foreach($news as $list)
                                        <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                            <div class="itemCont">
                                                <a href="{{route('articles', $list->id)}}">
                                                    <div class="about_wrap thumb">
                                                        <div class="holder"><img class="img-responsive center-block"
                                                                                 src="/images/{{$list->image_name}}"
                                                                                 alt="about"></div>
                                                    </div>
                                                    <div class="itemInfo">
                                                        <h4>{{$list->title}}</h4>
                                                        <h6>{{$list->sections->section_name}}</h6>
                                                        <p>{{$list->description}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="paginate">{{$news->links()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--/News-->

    <!--Photos-->
    @if(count($photos) > 0)
        <div id="photos" class="photos page-section1">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class=" container TitleSection">
                            <header class="page-head">
                                <h2>Галерея</h2>
                            </header>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 ">
                                <section class="slider">
                                    <div class="flexslider">
                                        <ul class="slides">
                                            @foreach($photos as $one)
                                                <li data-thumb="/images/{{$one->name}}">
                                                    <img src="/images/{{$one->name}}" class="center-block"/>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <a href="{{route('gallery', $users->id)}}">
                                <button type="button" class="btn btn-primary goto">ВСЕ ФОТОГРАФИИ</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--/Photos-->

    <!--Contact -->
    <div id="contact" class="contact page-section1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h2>Контакты</h2>
                        </header>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-7 col-sm-12">
                            <div class="contact_wrap">
                                <h3>Напишите нам:</h3>
                                <form method="post" id="mail_form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" size="50" name="name" id="name" value=""
                                               class="form-control required" placeholder="Введите Ваше имя*"
                                               required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" size="50" name="email" id="email" value=""
                                               class="form-control required email" placeholder="Введите Ваш E-mail*"
                                               required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" pattern="[0-9]{10}" size="50" name="phone" id="phone"
                                               value=""
                                               class="form-control required phone"
                                               placeholder="Введите номер телефона в формате +38 ХХX XXX XX XX*"
                                               required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" size="50" name="subject" id="subject" value=""
                                               class="form-control" placeholder="Введите тему сообщения"/>
                                    </div>
                                    <div class="form-group">
                                          <textarea class="form-control required" name="msg" rows="6" id="message"
                                                    name="message" placeholder="Введите текст сообщения*"
                                                    required></textarea>
                                    </div>
                                    <input type="hidden" value="{{optional($users->user)->email}}" name="imail"/>
                                    <button type="submit" class="btn btn-primary goto">Отправить сообщение</button>
                                </form>
                            </div>
                            <h4 id="modal" style="display: none;">Сообщение успешно отправлено!</h4>
                        </div>

                        <div class="col-xs-12 col-md-5 col-sm-12">
                            <div class="jumbotron">
                                <h3>Контактная информация:</h3>
                                <address>
                                    <strong>{{$users->section_name}}</strong><br>
                                    {{$users->address}}<br>
                                    <strong>Телефон:</strong>{{optional($users->user)->phone}}<br>
                                </address>
                                <address>
                                    <strong>Email:</strong> <a
                                            href="mailto:<?php echo(optional($users->user)->email);?>">{{optional($users->user)->email}}</a><br>
                                </address>
                            </div>
                            <div class="google">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /contact -->

    <script type="text/javascript"
            src="//maps.googleapis.com/maps/api/js?key=AIzaSyB1Ths24pUitBJWCL2hVzX58hz4qMjsKGA"></script>
    <script>
        var map;
        google.maps.event.addDomListener(window, "load", function () {
            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>),
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var infoWindow = new google.maps.InfoWindow();

            function createMarker(options, html) {
                var marker = new google.maps.Marker(options);
                if (html) {
                    google.maps.event.addListener(marker, "click", function () {
                        infoWindow.setContent(html);
                        infoWindow.open(options.map, this);
                    });
                }
                return marker;
            }

            var marker1 = createMarker({
                position: new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>),
                map: map
            }, "<h4 class='map_title';><?php echo($users->section_name); ?></h4><p><?php echo(optional($users->user)->phone); ?></p>");

        });
    </script>
    <script>
        $(document).ready(function () {
            $('#mail_form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/section/send',
                    data: $('#mail_form').serialize(),
                    success: function (result) {
                        jQuery('#mail_form')[0].reset();
                        document.getElementById('modal').style.display = "block";
                    }
                });
            });
        });
    </script>
@endsection