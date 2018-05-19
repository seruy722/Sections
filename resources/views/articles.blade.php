@extends('layouts.ap')

@section('content')
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
                                                    <h6>{{$list->user->name}}</h6>
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