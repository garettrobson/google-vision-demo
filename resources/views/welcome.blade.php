@extends('layouts.base')

@section('title', 'Images')

@section('content')
    <div class="jumbotron">
      <h1 class="display-4">Google Vision Demo</h1>
      <p class="lead">Created by Garett Robson</p>
      <hr class="my-4">
      <a class="btn btn-primary btn-lg" href="{{ route('images.index') }}" role="button">Get Started</a>
    </div>
@endsection
