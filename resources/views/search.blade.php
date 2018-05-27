
@extends('layouts.app')

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12" search>
        <div class="msg" style="padding-top: 2.5%; padding-bottom: 2.5%;">Результаты поиска по вашему запросу
            <b> {{ $query }} </b>:
        </div>
    </div>

    @if(isset($detail))
        <div id="sections" class="sections ha-waypoint page-section" data-animate-down="ha-header-small "
             data-animate-up="ha-header-large">
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
                                                    <div class="hexagon"><a href="{{route('section', $a->id)}}"> <span class="mask"></span> <img
                                                                    src="/images/content.jpg" alt="filter"> </a>
                                                    </div>
                                                    @endforeach
                                                    <div class="wrap">
                                                        <h4>{{$section}}</h4>
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
                                                    <div class="thumb"><img class="img-responsive center-block"
                                                                            alt="Blue Gate"
                                                                            src="/images/img1.jpg"></div>
                                                    <div class="itemInfo">
                                                        <h4>{{$news->title}}</h4>
                                                        <h6>{{$news->sections->sections_name}}</h6>
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