@extends('images.base')

@section('title', 'View Images')

@section('content')
    @parent
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>File Name</th>
                <th>Labels</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
                <tr>
                    <td>
                        @if($image->thumbnail)
                            <a href="{{ $image->path }}">
                                <img src="/{{ $image->thumbnail }}" />
                            </a>
                        @endif
                    </td>
                    <td>{{ $image->file_name }}</td>
                    <td>
                        @foreach($image->labelsSorted as $label)
                            <a href="{{ route('images.index.filter', ['filter' => $label]) }}" class="badge badge-{{ $filter && ($filter->id === $label->id) ? 'primary' : 'secondary' }}">
                                {{ $label->label }}
                            </a>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('images.destroy', ['image' => $image ]) }}" method="POST">
                            @method('DELETE')
                            @csrf()
                            <input type="hidden" value="{{ $image->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $images->links("pagination::bootstrap-4") }}
@endsection
