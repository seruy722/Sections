@extends('layouts.app')

@section('content')
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
                            <div class="contact_wrap" >
                                <h3>Напишите нам:</h3>
                                <form method="post" id="mail_form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" size="50" name="name" id="name" value="" class="form-control required" placeholder="Введите Ваше имя *" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" size="50" name="email" id="email" value="" class="form-control required email" placeholder="Введите Ваш E-mail*" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" pattern="[0-9]{10}" size="50" name="phone" id="phone" value="" class="form-control required phone" placeholder="Ваш номер мобильного телефона*" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" size="50" name="subject" id="subject" value="" class="form-control" placeholder="Введите тему сообщения"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control required" name="msg" rows="6" id="message" name="message" placeholder="Введите текст сообщения*" required></textarea>
                                    </div>
                                    <input type="hidden" value="{{$users->email}}" name="imail" />
                                    <button type="submit" class="btn btn-primary goto">Отправить сообщение</button>
                                </form>
                            </div>
                            <h4 id="modal" style="display: none;">Сообщение успешно отправлено!</h4>
                        </div>

                        <div class="col-xs-12 col-md-5 col-sm-12">
                            <div class="jumbotron">
                                <h3>Контактная информация:</h3>
                                <address>
                                    <strong>{{$users->name}}</strong><br>
                                    {{$users->address}}<br>
                                    <strong>Телефон:</strong>{{$users->sections->phone}}<br>
                                </address>
                                <address>
                                    <strong>Email:</strong> <a href="mailto:<?php echo($users->email);?>">{{$users->email}}</a><br>
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
            }, "<h4><?php echo($users->name); ?></h4><p><?php echo($users->sections->phone); ?></p>");

        });
    </script>
    <script>
        $(document).ready(function(){
            $('#mail_form').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/section/send',
                    data: $('#mail_form').serialize(),
                    success: function(result){
                        jQuery('#mail_form')[0].reset();
                        document.getElementById('modal').style.display = "block";
                    }
                });
            });
        });
    </script>
@endsection