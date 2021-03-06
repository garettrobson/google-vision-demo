@extends('images.base')

@section('title', 'Web Image')

@section('content')
    @parent
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning" role="alert">
            {{ $error }}
        </div>
    @endforeach
    @endif
    <form method="POST" action="{{ route('images.store.web') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="url">URL</label>
            <input type="input" class="form-control" id="url" name="url">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
