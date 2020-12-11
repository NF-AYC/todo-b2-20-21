@extends('layouts.main')

@section('title', "Create a new task")


@section('content')
    <p>Add a task </p>
    <div>
        <form action="{{route('tasks.store', $board)}}" method="POST">
            @csrf
            
            <label for="title">title</label>
            <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror">

            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <label for="description">Description</label>
            <input type='textarea' name='description' id="description" >
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <label for="due_date">Date de fin</label>
            <input type='date' name='due_date' id="due_date" >
            <br>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <button type="submit">Create</button>
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