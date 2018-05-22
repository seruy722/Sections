@extends('layouts.app')

@section('content')
<!-- News-->
    <div id="news" class="news">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="imgSwitch">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 dbox-list prod-cnt graphic">
                                    <div class="itemCont">
                                        <h2>{{$post->title}}</h2>
                                        <h4>{{$post->user->name}}</h4>
                                        <div class="thumb_img"><img class="img-responsive center-block" alt="Blue Gate" src="/images/img1.jpg"></div>
                                        <div class="itemInfo">
                                            <p>{{$post->content}}</p>
                                        </div>
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