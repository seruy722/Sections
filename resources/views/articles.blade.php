@extends('layouts.app')

@section('content')
    <div class="row search">
        <div class="col-xs-12 col-md-12 col-sm-12">
            <form action="/articles/search" method="POST" role="search" class="form-search">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-11">
                        <div class="form-group">
                            <input id="input" type="text" class="form-control" name="q" value="{{ old('q') }}" required>
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <div class="form-group">
                            <input class="btn btn-info" type="submit" value="Поиск">
                        </div>
                    </div>
                </div>
            </form>
            <div class="msg">{{Session::get('msg')}}</div>
        </div>
    </div>
    <!-- News-->
    <div id="news" class="news">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="imgSwitch">
                            <div class="row">
                                @foreach($all as $list)
                                    <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                        <div class="itemCont">
                                            <a href="{{route('articles', $list->id)}}">
                                                <div class="thumb"><img class="img-responsive center-block"
                                                                        alt="Blue Gate"
                                                                        src="/images/img1.jpg"></div>
                                                <div class="itemInfo">
                                                    <h4>{{$list->title}}</h4>
                                                    <h6>{{$list->section_name}}</h6>
                                                    <p>{{$list->description}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="paginate">{{$all->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news -->
@endsection