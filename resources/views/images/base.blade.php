@extends('layouts.base')

@section('content')
    @parent
    <a href="{{ route('images.index') }}">View Images</a> |
    <a href="{{ route('images.create') }}">Add Image From File</a> |
    <a href="{{ route('images.create.web') }}">Add Image From Url</a>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('messages.danger'))
        @foreach(session()->pull('messages.danger') as $message)
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endforeach
    @endif
@endsection
