@extends('admin.layout')

@section('content')
    <div class="header">
        <h2>Manage Portfolio</h2>
        <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th width="100">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portfolios as $item)
                <tr>
                    <td><img src="{{ asset($item->image) }}" alt=""></td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category }}</td>
                    <td>
                        <a href="{{ route('admin.portfolio.edit', $item->id) }}" class="btn btn-gold">Edit</a>
                        <form action="{{ route('admin.portfolio.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus item ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $portfolios->links() }}
    </div>
@endsection