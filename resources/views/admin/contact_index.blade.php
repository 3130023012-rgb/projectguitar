@extends('admin.layout')

@section('content')
<div class="header">
    <h2>Contact Messages</h2>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Instrument</th>
                <th>Message</th>
                <th width="100">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
            <tr>
                <td>{{ $msg->created_at->format('d M Y') }}</td>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->instrument }}</td>
                <td>{{ Str::limit($msg->message, 50) }}</td>
                <td>
                    <form action="{{ route('admin.contact.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
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