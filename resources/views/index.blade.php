@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-12 col-sm-12">
    <div id='search-box'>
    <form action="/search" method="POST" id='search-form' target='_top'>
        {{ csrf_field() }}
        <input id="input" type="text" id='search-text' name="q" value="{{ old('q') }}" required>
        <button id='search-button' type='submit'>
            <span>Поиск</span>
        </button>
    </form>
    </div>
        <div class="msg">{{Session::get('msg')}}</div>
    </div>
    </div>
    <!-- Sections -->
    <div id="sections" class="sections ha-waypoint page-section" data-animate-down="ha-header-small "
         data-animate-up="ha-header-large">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h2>Кружки</h2>
                        </header>
                    </div>
                    <div class="row">
                        <div class="sec_wrap_3 option3">
                            @foreach($category as $cat)
                                <div class="col-xs-12 col-md-4 col-sm-6">
                                    <ul>
                                        <li>
                                            <div class="about_wrap_one">
                                                <div class="hexagon"><a href="{{route('sections', $cat->id)}}"> <span
                                                                class="mask"></span> <img
                                                                src="/images/{{$cat->image}}" alt="filter"> </a>
                                                </div>
                                                <div class="wrap">
                                                    <h4>{{$cat->name}}</h4>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sections -->

    <!-- Schedule -->
    <div id="schedule" class="schedule page-section">
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
                                        @foreach($monday as $day=>$a)
                                            <tr>
                                                <th colspan="7">@foreach ($a as $b)<a
                                                            href="{{route('section', $b->id)}}">@endforeach{{$day}}</a>
                                                </th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_start}}</td>
                                                    <td>{{$b->event_end}}</td>
                                                    <td>{{$b->event_name}}</td>
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
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tuesday as $day=>$a)
                                            <tr>
                                                <th colspan="7">@foreach ($a as $b)<a
                                                            href="{{route('section', $b->id)}}">@endforeach{{$day}}</a>
                                                </th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_start}}</td>
                                                    <td>{{$b->event_end}}</td>
                                                    <td>{{$b->event_name}}</td>
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
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wednesday as $day=>$a)
                                            <tr>
                                                <th colspan="7">@foreach ($a as $b)<a
                                                            href="{{route('section', $b->id)}}">@endforeach{{$day}}</a>
                                                </th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_start}}</td>
                                                    <td>{{$b->event_end}}</td>
                                                    <td>{{$b->event_name}}</td>
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
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($thursday as $day=>$a)
                                            <tr>
                                                <th colspan="7">@foreach ($a as $b)<a
                                                            href="{{route('section', $b->id)}}">@endforeach{{$day}}</a>
                                                </th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_start}}</td>
                                                    <td>{{$b->event_end}}</td>
                                                    <td>{{$b->event_name}}</td>
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
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($friday as $day=>$a)
                                            <tr>
                                                <th colspan="7">@foreach ($a as $b)<a
                                                            href="{{route('section', $b->id)}}">@endforeach{{$day}}</a>
                                                </th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_start}}</td>
                                                    <td>{{$b->event_end}}</td>
                                                    <td>{{$b->event_name}}</td>
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
                                            <th class="col-md-1">Время начала занятия</th>
                                            <th class="col-md-1">Время окончания занятия</th>
                                            <th class="col-md-1">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($saturday as $day=>$a)
                                            <tr>
                                                <th colspan="7">@foreach ($a as $b)<a
                                                            href="{{route('section', $b->id)}}">@endforeach{{$day}}</a>
                                                </th>
                                            </tr>
                                            @foreach($a as $b)
                                                <tr>
                                                    <td>{{$b->event_start}}</td>
                                                    <td>{{$b->event_end}}</td>
                                                    <td>{{$b->event_name}}</td>
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

    @if(count($news) > 0)
    <!-- News-->
    <div id="news" class="news page-section">
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
                                                                             src="/images/{{$list->image_name}}" alt="about"></div>
                                                </div>
                                                <div class="itemInfo">
                                                    <h4>{{$list->title}}</h4>
                                                    <h6>{{optional($list->sections)->section_name}}</h6>
                                                    <p>{{$list->description}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <a href="{{route('news')}}">
                                    <button type="button" class="btn btn-primary goto">ВСЕ НОВОСТИ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- news -->
@endsection
