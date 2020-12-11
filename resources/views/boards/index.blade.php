@extends('layouts.main')

@section('title', "User's boards")


@section('content')
    <p>Ici on va afficher les boards auxquels appartient l'utilisateur {{$user->name}}.</p>
    <div>Les boards de l'utilisateur</div>
    @foreach ($user->boards as $board)
        <p>Le board {{ $board->title }} : 
                <a href="{{route('boards.show', $board)}}">Voir</a>
                <a href="{{route('boards.edit', $board)}}">Edit</a>
                <form method='POST' action="{{route('boards.destroy', $board)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </p>
    @endforeach
@endsection