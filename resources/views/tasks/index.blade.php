@extends('layouts.main')

@section('title', "User's board")


@section('content')
    <p>Il faut parcourir et afficher tous le boards. </p>
    @foreach ($boards as $board)
        <p>This is board {{ $board->title }}. 
            <a href="{{route('boards.show', $board)}}">detail</a></p>
            <form action="{{route('boards.destroy', $board->id)}}" method='POST'>
                @method('DELETE')
                @csrf
                
                <button type="submit">Delete</button>
            </form>
    @endforeach
@endsection