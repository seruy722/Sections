@extends('layouts.app')

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12" search>
        <div class="msg" style="padding-top: 2.5%; padding-bottom: 2.5%;">Результаты поиска по вашему запросу
            <b> {{ $query }} </b>:
        </div>
    </div>

    @if(isset($detail))
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="sec_wrap_3 option3">
                            @foreach($detail as $section=>$q)
                                <div class="col-xs-12 col-md-4 col-sm-12">
                                    <ul>
                                        <li>
                                            <div class="about_wrap_one">
                                                @foreach ($q as $a)
                                                    <a href="{{route('section', $a->id)}}">
                                                        <div class="effect eff-17">
                                                            <img
                                                                    src="/images/{{$a->img_logo}}" alt="filter">
                                                            <div class="triangle-set">
                                                                <div class="triangle triangle-1"></div>
                                                                <div class="triangle triangle-2"></div>
                                                                <div class="triangle triangle-3"></div>
                                                                <div class="triangle triangle-4"></div>
                                                            </div>
                                                            <div class="caption">
                                                                <p>Адрес: {{$a->address}}</p>
                                                                <p>Телефон: {{optional($a->user)->phone}}</p>
                                                                <p>Email: {{optional($a->user)->email}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        <div class="wrap">
                                                            <h4>{{$section}}</h4>
                                                        </div>
                                                    </a>
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
    @endif


    @if(isset($details))
        <div id="news" class="news">
            <div class="imgSwitch">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                        @foreach($details as $news)
                            <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                <div class="itemCont">
                                    <a href="{{route('articles', $news->id)}}">
                                        <div class="about_wrap thumb">
                                            <div class="holder"><img class="img-responsive center-block"
                                                                     src="/images/{{$news->image_name}}" alt="about"></div>
                                        </div>
                                        <div class="itemInfo">
                                            <h4>{{$news->title}}</h4>
                                            <h6>{{$news->sections->section_name}}</h6>
                                            <p>{{$news->description}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection