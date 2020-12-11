@extends('layouts.main')

@section('title', "Board's tasks")


@section('content')
    <h2>{{$board->title}}</h2>
    <h3>Liste des tâches</h3>
    @foreach ($board->tasks as $task)
        <p>{{ $task->title }}. 
            <a href="{{route('tasks.show', [$board, $task])}}">detail</a> <a href="{{route('tasks.edit', [$board, $task])}}">edit</a></p>
            <form action="{{route('tasks.destroy', [$board, $task])}}" method='POST'>
                @method('DELETE')
                @csrf
                
                <button type="submit">Delete</button>
            </form>
    @endforeach
@endsection