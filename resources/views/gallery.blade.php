@extends('layouts.app')

@section('content')
    <div id="news" class="news">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h2>Галерея</h2>
                            <p>{{$name}}</p>
                        </header>
                    </div>
                    <div class="tz-gallery">
                        <div class="row">
                            @foreach($img->image as $pic)
                                    <div class="photo">
                                        <a class="lightbox" href="/images/{{$pic->name}}">
                                            <img src="/images/{{$pic->name}}"
                                                 alt=""/></a>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
