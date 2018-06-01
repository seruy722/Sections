@extends('layouts.app')

@section('content')
    <!-- Sections -->
    <div id="sections" class="sections ha-waypoint page-section" data-animate-down="ha-header-small "
         data-animate-up="ha-header-large">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="sec_wrap_3 option3">
                            @foreach($sections->sections as $section)
                                <div class="col-xs-12 col-md-4 col-sm-12">
                                    <ul>
                                        <li>
                                            <div class="about_wrap_one">
                                                <a href="{{route('section', $section->id)}}">
                                                    <div class="effect eff-17">
                                                        <img
                                                                src="/images/{{$section->img_logo}}" alt="filter">
                                                        <div class="triangle-set">
                                                            <div class="triangle triangle-1"></div>
                                                            <div class="triangle triangle-2"></div>
                                                            <div class="triangle triangle-3"></div>
                                                            <div class="triangle triangle-4"></div>
                                                        </div>
                                                        <div class="caption">
                                                            <p>Адрес: {{$section->address}}</p>
                                                            <p>Телефон: {{optional($section->user)->phone}}</p>
                                                            <p>Email: {{optional($section->user)->email}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="wrap">
                                                        <h4>{{$section->section_name}}</h4>
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
@endsection