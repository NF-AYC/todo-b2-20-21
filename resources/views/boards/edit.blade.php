@extends('layouts.main')

@section('title', "Edit a board for an user")


@section('content')
    <h2>Éditer un board</p>
        <form action="{{route('boards.update', $board)}}" method="POST">
            @method('PUT')
            @csrf
            <label for="title">Title</label>
            <input type="text" name='title' 
                    id ='title' value="{{$board->title}}"
                    class="@error('title') is-invalid @enderror" required><br>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="description">Description</label>
            <input type="text" name='description' id ='description' value="{{$board->description}}"
                    class="@error('description') is-invalid @enderror"><br>
            <button type="submit">Update</button>
        </form>
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
@endsection