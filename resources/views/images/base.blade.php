@extends('layouts.base')

@section('content')
    @parent
    <a href="{{ route('images.index') }}">View Images</a> |
    <a href="{{ route('images.create') }}">Add Image From File</a> |
    <a href="{{ route('images.create.web') }}">Add Image From Url</a>
@endsection
