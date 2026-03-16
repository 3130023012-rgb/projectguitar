@extends('admin.layout')

@section('content')
<div class="header">
    <h2>Product Categories</h2>
</div>

<div class="card" style="margin-bottom: 20px;">
    <h4 style="margin-bottom: 15px;">Add New Category</h4>
    
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div style="display: flex; gap: 10px;">
            <input type="text" name="name" class="form-control" placeholder="Category Name (e.g., Electric Guitars)" required>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Total Produk</th>
                <th width="100">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($categories as $cat)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->slug }}</td>
                <td>{{ $cat->products->count() }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection