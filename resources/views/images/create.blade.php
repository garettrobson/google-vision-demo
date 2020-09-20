@extends('images.base')

@section('title', 'Upload Images')

@section('content')
    @parent
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image-upload">Image File</label>
            <input type="file" class="form-control-file" id="image-upload" name="image-upload">
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
    </form>
@endsection
