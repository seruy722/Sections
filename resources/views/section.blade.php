@extends('layouts.app')

@section('content')
    <!-- About -->
    <div id="about" class="about ha-waypoint" data-animate-down="ha-header-small" data-animate-up="ha-header-large">
        <div class="container">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="container TitleSection">
                    <header class="page-head">
                        <h2>О нас</h2>
                    </header>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <div class="log"><img src="/images/passion.png" alt="filter"></div>
                        <p class="text-justify">{{$users->info}}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->
    <!-- Schedule -->
    <div id="schedule" class="schedule">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h2>Расписание</h2>
                        </header>
                    </div>
                    <div class="cd-schedule loading">
                        <div class="timeline">
                            <ul>
                                <li><span>08:00</span></li>
                                <li><span>09:00</span></li>
                                <li><span>10:00</span></li>
                                <li><span>11:00</span></li>
                                <li><span>12:00</span></li>
                                <li><span>13:00</span></li>
                                <li><span>14:00</span></li>
                                <li><span>15:00</span></li>
                                <li><span>16:00</span></li>
                                <li><span>17:00</span></li>
                                <li><span>18:00</span></li>
                                <li><span>19:00</span></li>
                                <li><span>20:00</span></li>
                            </ul>
                        </div>
                        <!-- .timeline -->

                        <div class="events">
                            <ul>
                                <li class="events-group">
                                    <div class="top-info"><span>Понедельник</span></div>
                                    <ul>
                                        <?php $i = 0 ?>
                                        @foreach ($monday as $day)
                                            <?php $i++; ?>
                                            <li class="single-event"
                                                data-start={{$day->event_start}} data-end={{$day->event_end}} data-content="event-rowing-workout"
                                                data-event="event-1">
                                                <p><em class="event-name">Занятие <?php echo $i; ?></em></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="events-group">
                                    <div class="top-info"><span>Вторник</span></div>
                                    <ul>
                                        <?php $i = 0 ?>
                                        @foreach ($tuesday as $day)
                                            <?php $i++; ?>
                                            <li class="single-event"
                                                data-start={{$day->event_start}} data-end={{$day->event_end}} data-content="event-rowing-workout"
                                                data-event="event-2">
                                                <p><em class="event-name">Занятие <?php echo $i; ?></em></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="events-group">
                                    <div class="top-info"><span>Среда</span></div>

                                    <ul>
                                        <?php $i = 0 ?>
                                        @foreach ($wednesday as $day)
                                            <?php $i++; ?>
                                            <li class="single-event"
                                                data-start={{$day->event_start}} data-end={{$day->event_end}} data-content="event-rowing-workout"
                                                data-event="event-3">
                                                <p><em class="event-name">Занятие <?php echo $i; ?></em></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="events-group">
                                    <div class="top-info"><span>Четверг</span></div>
                                    <ul>
                                        <?php $i = 0 ?>
                                        @foreach ($thursday as $day)
                                            <?php $i++; ?>
                                            <li class="single-event"
                                                data-start={{$day->event_start}} data-end={{$day->event_end}} data-content="event-rowing-workout"
                                                data-event="event-4">
                                                <p><em class="event-name">Занятие <?php echo $i; ?></em></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="events-group">
                                    <div class="top-info"><span>Пятница</span></div>
                                    <ul>
                                        <?php $i = 0 ?>
                                        @foreach ($friday as $day)
                                            <?php $i++; ?>
                                            <li class="single-event"
                                                data-start={{$day->event_start}} data-end={{$day->event_end}} data-content="event-rowing-workout"
                                                data-event="event-5">
                                                <p><em class="event-name">Занятие <?php echo $i; ?></em></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="events-group">
                                    <div class="top-info"><span>Суббота</span></div>
                                    <ul>
                                        <?php $i = 0 ?>
                                        @foreach ($saturday as $day)
                                            <?php $i++; ?>
                                            <li class="single-event"
                                                data-start={{$day->event_start}} data-end={{$day->event_end}} data-content="event-rowing-workout"
                                                data-event="event-6">
                                                <p><em class="event-name">Занятие <?php echo $i; ?></em></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- .cd-schedule -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Schedule -->

    <!-- News-->
    <div id="news" class="news">
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
                                                <div class="thumb"><img class="img-responsive center-block"
                                                                        alt="Blue Gate"
                                                                        src="/images/img1.jpg"></div>
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
    <!-- News-->
    <!--Photos-->
    <div id="photos" class="photos">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h2>Фото</h2>
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
                    </div>
                </div>
            </div>
        </div>
    <div>
    <!--/Photos-->
    <a href="{{route('gallery', $users->id)}}">
        <button type="button" class="btn btn-primary goto">ВСЕ ФОТОГРАФИИ</button>
    </a></div>
    <!--Contact -->
    <div id="contact" class="contact">
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
                zoom: 14,
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
            }, "<h4><?php echo($users->section_name); ?></h4><p><?php echo(optional($users->user)->phone); ?></p>");

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