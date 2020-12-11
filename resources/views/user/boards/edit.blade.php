@extends('layouts.main')

@section('title', "Edit board" . $board->title)


@section('content')
    <p>Add a board </p>
    <div>
        <form action="{{route('boards.update', $board)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="title">title</label>
            <input id="title" name="title" type="text" class="@error('title') is-invalid @enderror" value="{{$board->title}}">

            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <label for="description">Description</label>
            <input type='textarea' name='description' id="description" value="{{$board->description}}">
            <br>
            <button type="submit">Update</button>
        </form>

    </div>
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