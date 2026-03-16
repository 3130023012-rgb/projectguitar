@extends('admin.layout')

@section('content')
<div class="header">
    <h2>Shop Products</h2>
    <a href="{{ route('admin.shop.create') }}" class="btn btn-primary">+ Add Product</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th width="80">Img</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th width="200">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
            <tr>
                <td><img src="{{ asset($item->image) }}" style="width:60px; height:60px; object-fit:cover;"></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name ?? 'N/A' }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>
                    <a href="{{ route('admin.shop.edit', $item->id) }}" class="btn btn-gold">Edit</a>
                    <form action="{{ route('admin.shop.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Del</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection