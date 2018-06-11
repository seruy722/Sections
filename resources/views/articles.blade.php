@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-12 col-sm-12">
            <div id='search-box'>
                <form action="/articles/search" method="POST" id='search-form' target='_top'>
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
    <!-- News-->
    <div id="news" class="news ha-waypoint" data-animate-down="ha-header-small "
         data-animate-up="ha-header-large">
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