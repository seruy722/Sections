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
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Клуб современного танца "Ритм"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Творческий Центр "Fleur-de-Lys"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Студия современного танца Fly dance</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
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
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Клуб современного танца "Ритм"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Творческий Центр "Fleur-de-Lys"</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
                                        <div class="wrap">
                                            <h4>Студия современного танца Fly dance</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-md-3 col-sm-12">
                                <ul>
                                    <li>
                                        <div class="icon_sec"><img src="/images/favicon.png" alt=""></div>
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
                                @foreach($news as $list)
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                    <div class="itemCont">
                                        <a href="{{route('articles', $list->id)}}">
                                            <div class="thumb"><img class="img-responsive center-block" alt="Blue Gate"
                                                                    src="/images/img1.jpg"></div>
                                            <div class="itemInfo">
                                                <h4>{{$list->title}}</h4>
                                                <h6>{{$list->user->name}}</h6>
                                                <p>{{$list->description}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                    @endforeach
                                    <button type="button" class="btn btn-primary goto">Посмотреть все новости</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news -->
@endsection