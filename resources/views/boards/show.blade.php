@extends('layouts.main')

@section('title', "THE board")


@section('content')
    <h2>Bienvenu dans le board {{$board->title}}</h2>
    @foreach ($board->users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
@endsection