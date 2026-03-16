@extends('admin.layout')

@section('content')
    <div class="header">
        <h2>{{ isset($portfolio) ? 'Edit Portfolio' : 'Add New Portfolio' }}</h2>
    </div>

    <div class="card">
        <form action="{{ isset($portfolio) ? route('admin.portfolio.update', $portfolio->id) : route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($portfolio)) @method('PUT') @endif

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $portfolio->title ?? old('title') }}" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-control" value="{{ $portfolio->category ?? old('category') }}" required placeholder="e.g., Electric Guitar">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ $portfolio->description ?? old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" {{ isset($portfolio) ? '' : 'required' }}>
                @if(isset($portfolio))
                    <br>
                    <img src="{{ asset($portfolio->image) }}" width="150">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Save Portfolio</button>
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-danger" style="border-color:#666; color:#666;">Cancel</a>
        </form>
    </div>
@endsection