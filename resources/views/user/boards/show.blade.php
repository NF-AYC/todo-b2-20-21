@extends('layouts.main')

@section('title', "User's board " . $board->title)


@section('content')
    <h2>{{$board->title}}</h2>
    <p>{{$board->description}}</p>
    <div class="participants">
        @foreach($board->users as $user) 
            <p>{{$user->name}}</p>
            <form action="{{route('boards.boarduser.destroy', $user->pivot)}}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit">Supprimer</button>
            </form>
        @endforeach
    </div>

    <form action="{{route('boards.boarduser.store', $board)}}" method="POST">
        @csrf
        <select name="user_id" id="user_id">
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}} : {{$user->email}}</option>
            @endforeach
        </select>
        @error('user_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Ajouter</button>
    </form>

@endsection