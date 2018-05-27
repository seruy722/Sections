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
                                                <div class="hexagon"><a href="{{route('section', $section->id)}}"> <span class="mask"></span> <img
                                                                src="/images/content.jpg" alt="filter"> </a>
                                                </div>
                                                <div class="wrap">
                                                    <h4>{{$section->sections_name}}</h4>
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
@endsection