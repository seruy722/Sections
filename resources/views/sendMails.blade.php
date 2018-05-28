@extends('layouts.mail')

@section('content')
    <h2>{{$subject}}</h2>
    <p>{{$msg}}</p>
@endsection