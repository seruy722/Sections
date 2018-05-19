@extends('layouts.ap')

@section('content')
    <!-- Sections -->
    <div id="sections" class="sections ha-waypoint" data-animate-down="ha-header-small"
         data-animate-up="ha-header-large">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h3>Танцы</h3>
                        </header>
                    </div>
                    <div class="row">
                        <div class="sec_wrap_3 option3">
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Клуб современного танца "Ритм"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Творческий Центр "Fleur-de-Lys"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Студия современного танца Fly dance</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Танцевальный центр Элегия</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h3>Танцы</h3>
                        </header>
                    </div>
                    <div class="row">
                        <div class="sec_wrap_3 option3">
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Клуб современного танца "Ритм"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Творческий Центр "Fleur-de-Lys"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Студия современного танца Fly dance</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="./images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Танцевальный центр Элегия</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sections -->

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
                                        <th class="col-md-1">Название</th>
                                        <th class="col-md-1">Время начала</th>
                                        <th class="col-md-3">Время окончания</th>
                                        <th class="col-md-2">Информация</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monday as $day=>$a)
                                        <tr>
                                            <th colspan="7">{{$day}}</th>
                                        </tr>
                                        @foreach($a as $b)
                                            <tr>
                                                <td>{{$b->event_name}}</td>
                                                <td>{{$b->data_start}}</td>
                                                <td>{{$b->data_end}}</td>
                                                <td>{{$b->event_info}}</td>
                                            </tr>
                                        @endforeach
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
                                            <th class="col-md-1">Название</th>
                                            <th class="col-md-1">Время начала</th>
                                            <th class="col-md-3">Время окончания</th>
                                            <th class="col-md-2">Информация</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tuesday as $day=>$a)
                                            <tr>
                                                <th colspan="7">{{$day}}</th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_name}}</td>
                                                    <td>{{$b->data_start}}</td>
                                                    <td>{{$b->data_end}}</td>
                                                    <td>{{$b->event_info}}</td>
                                                </tr>
                                            @endforeach
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
                                            <th class="col-md-1">Название</th>
                                            <th class="col-md-1">Время начала</th>
                                            <th class="col-md-3">Время окончания</th>
                                            <th class="col-md-2">Информация</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wednesday as $day=>$a)
                                            <tr>
                                                <th colspan="7">{{$day}}</th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_name}}</td>
                                                    <td>{{$b->data_start}}</td>
                                                    <td>{{$b->data_end}}</td>
                                                    <td>{{$b->event_info}}</td>
                                                </tr>
                                            @endforeach
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
                                            <th class="col-md-1">Название</th>
                                            <th class="col-md-1">Время начала</th>
                                            <th class="col-md-3">Время окончания</th>
                                            <th class="col-md-2">Информация</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($thursday as $day=>$a)
                                            <tr>
                                                <th colspan="7">{{$day}}</th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_name}}</td>
                                                    <td>{{$b->data_start}}</td>
                                                    <td>{{$b->data_end}}</td>
                                                    <td>{{$b->event_info}}</td>
                                                </tr>
                                            @endforeach
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
                                            <th class="col-md-1">Название</th>
                                            <th class="col-md-1">Время начала</th>
                                            <th class="col-md-3">Время окончания</th>
                                            <th class="col-md-2">Информация</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($friday as $day=>$a)
                                            <tr>
                                                <th colspan="7">{{$day}}</th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_name}}</td>
                                                    <td>{{$b->data_start}}</td>
                                                    <td>{{$b->data_end}}</td>
                                                    <td>{{$b->event_info}}</td>
                                                </tr>
                                            @endforeach
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
                                            <th class="col-md-1">Название</th>
                                            <th class="col-md-1">Время начала</th>
                                            <th class="col-md-3">Время окончания</th>
                                            <th class="col-md-2">Информация</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($saturday as $day=>$a)
                                            <tr>
                                                <th colspan="7">{{$day}}</th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_name}}</td>
                                                    <td>{{$b->data_start}}</td>
                                                    <td>{{$b->data_end}}</td>
                                                    <td>{{$b->event_info}}</td>
                                                </tr>
                                            @endforeach
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
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block" alt="Blue Gate"
                                                                    src="images/img1.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>The Blue Gate</h4>
                                                <h6>Graphic</h6>
                                                <p>Etiam faucibus id orci et mollis. Donec at ultricies erat. Sed
                                                    sodales dapibus felis vehicula tempus. Class aptent taciti sociosqu
                                                    ad litora torquent per conubia nostra, per inceptos himenaeos.
                                                    Nullam id eros ac elit blandit vestibulum sed non erat.</p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt webdesign">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block"
                                                                    alt="Womens Stone" src="images/img2.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>Women's Stone</h4>
                                                <h6>Webdesign</h6>
                                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                                                    per inceptos himenaeos. Etiam suscipit ipsum eget est commodo, quis
                                                    pellentesque nisi blandit. Proin vitae felis ac est viverra faucibus
                                                    vel eu nisl.</p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt creative">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block" alt="Elves Past"
                                                                    src="images/img3.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>Elves of Past</h4>
                                                <h6>Creative</h6>
                                                <p>Cras et adipiscing nulla, ut pulvinar lectus. Duis facilisis
                                                    vulputate sapien sed pretium. Vivamus imperdiet purus nec vestibulum
                                                    venenatis. Maecenas ultricies velit eget dui viverra, vitae iaculis
                                                    lorem dignissim.</p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt inspiration">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block"
                                                                    alt="Silken Wife" src="images/img4.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>The Silken Wife</h4>
                                                <h6>Inspiration</h6>
                                                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                                    posuere cubilia Curae; In pharetra lorem non libero eleifend varius.
                                                    Ut vel augue purus. Sed auctor accumsan nulla, eget imperdiet sapien
                                                    tincidunt quis.</p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt webdesign">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block"
                                                                    alt="Some Vision" src="images/img5.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>Some Vision</h4>
                                                <h6>Webdesign</h6>
                                                <p>Donec rutrum, magna a aliquam suscipit, nisl urna vehicula neque, vel
                                                    feugiat nunc mi non velit. Vivamus id varius turpis. Nam vitae
                                                    tortor vitae magna malesuada congue. </p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt inspiration">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block" alt="Snow Woman"
                                                                    src="images/img6.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>Snow of Woman</h4>
                                                <h6>Inspiration</h6>
                                                <p>Vivamus justo nisi, ornare id lobortis non, cursus in enim. Quisque
                                                    semper dui vitae tempor dictum. Duis nec luctus est, eget dictum
                                                    ipsum. Pellentesque ultrices posuere metus sit amet volutpat.</p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block"
                                                                    alt="Mist Witches" src="images/img7.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>Mist Witches</h4>
                                                <h6>Graphic</h6>
                                                <p>Nulla sagittis mi ante. Mauris a nunc id sapien iaculis sodales vel a
                                                    turpis. Proin a velit fermentum, rutrum enim sed, venenatis diam.
                                                    Nunc commodo lorem quis sagittis luctus. Praesent faucibus fermentum
                                                    eros at lacinia.</p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt creative">
                                    <div class="itemCont">
                                        <a href="#">
                                            <div class="thumb"><img class="img-responsive center-block"
                                                                    alt="Wind of Worlds" src="images/img8.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>Wind of Worlds</h4>
                                                <h6>Creative</h6>
                                                <p>Sed tellus risus, mollis sit amet ultrices vel, fermentum porttitor
                                                    felis. Morbi porta placerat facilisis. Ut pretium, nunc et luctus
                                                    bibendum, nulla ipsum malesuada justo, sit amet adipiscing nunc
                                                    nulla et magna.</p>
                                            </div>
                                        </a>
                                        <button type="button" class="btn btn-primary goto">view</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news -->
@endsection