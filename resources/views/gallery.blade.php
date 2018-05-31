@extends('layouts.app')

@section('content')
    <div id="news" class="news">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class=" container TitleSection">
                        <header class="page-head">
                            <h2>Галерея</h2>
                        </header>
                    </div>
                    <div class="row">
                        <div class="imgSwitch">
                            <div class="row">
                                <div class="gallery">
                                    @foreach($img->image as $pic)
                                    <div class="img-w">
                                        <img src="/images/{{$pic->name}}"
                                             alt=""/></div>
                                        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
