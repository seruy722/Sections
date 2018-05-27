
@extends('layouts.mail')


@section('content')
    <h2>{{$subject}}</h2>

    <p>{{$title}}</p>

    <p><em>– {{$password}}</em></p>
@endsection
