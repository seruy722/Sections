@extends('layouts.ap')

@section('content')
    <div class="container">
        @if(isset($details))
            <div class="imgSwitch">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                        <div class="msg" style="padding-top: 2%;">Результаты поиска по вашему запросу
                            <b> {{ $query }} </b>: {{count($details)}}</div>
                        @foreach($details as $news)
                            <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                <div class="itemCont">
                                    <a href="{{route('articles', $news->id)}}">
                                        <div class="thumb"><img class="img-responsive center-block"
                                                                alt="Blue Gate"
                                                                src="/images/img1.jpg"></div>
                                        <div class="itemInfo">
                                            <h4>{{$news->title}}</h4>
                                            <h6>{{$news->user->name}}</h6>
                                            <p>{{$news->description}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection