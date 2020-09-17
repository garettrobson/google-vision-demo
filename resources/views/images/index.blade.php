@extends('layouts.base')

@section('title', 'Images')

@section('content')
    <a href="{{ route('images.create') }}" class="btn btn-primary">Add Image</a>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>File Name</th>
                <th>Mime Type</th>
                <th>Labels</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
                <tr>
                    <td>
                        <a href="{{ $image->path }}">
                            <img src="{{ $image->thumbnail }}" />
                        </a>
                    </td>
                    <td>{{ $image->file_name }}</td>
                    <td>{{ $image->mime_type }}</td>
                    <td>
                        <ul>
                        @foreach($image->labelsSorted as $label)
                            <li>{{ $label->label }}</li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $images->links("pagination::bootstrap-4") }}
@endsection
