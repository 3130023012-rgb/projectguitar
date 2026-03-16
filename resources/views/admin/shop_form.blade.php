@extends('admin.layout')

@section('content')
<div class="header">
    <h2>{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h2>
</div>

<div class="card">
    <form action="{{ isset($product) ? route('admin.shop.update', $product->id) : route('admin.shop.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        {{-- Baris 1: Nama & Kategori --}}
        <div style="display:flex; gap:20px; margin-bottom:20px;">
            <div class="form-group" style="flex:1;">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name ?? old('name') }}" required placeholder="e.g. Fender Stratocaster">
            </div>
            <div class="form-group" style="flex:1;">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="" disabled>Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ ($product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Baris 2: Harga, Status & New Arrival --}}
        <div style="display:flex; gap:20px; margin-bottom:20px;">
            <div class="form-group" style="flex:1;">
                <label>Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price ?? old('price') }}" required placeholder="1250.00">
            </div>
            <div class="form-group" style="flex:1;">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="active" {{ ($product->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="sale" {{ ($product->status ?? '') == 'sale' ? 'selected' : '' }}>On Sale</option>
                </select>
            </div>
            <div class="form-group" style="flex:1; display:flex; align-items:flex-end;">
                <label style="margin-bottom:0; cursor:pointer; padding: 15px 0;">
                    <input type="checkbox" name="is_new" value="1" {{ ($product->is_new ?? false) ? 'checked' : '' }}> 
                    Mark as New Arrival
                </label>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Product description...">{{ $product->description ?? old('description') }}</textarea>
        </div>

        {{-- Spesifikasi Dinamis --}}
        <div class="form-group">
            <label>Specifications (Key - Value)</label>
            <div id="spec-container">
                @php
                    // Decode JSON specs jika ada data lama
                    $oldSpecs = [];
                    if (isset($product) && !empty($product->specs)) {
                        $decoded = json_decode($product->specs, true);
                        if (is_array($decoded)) {
                            $oldSpecs = $decoded;
                        }
                    }
                @endphp
                
                @if(!empty($oldSpecs))
                    @foreach($oldSpecs as $key => $val)
                        <div class="spec-row" style="display:flex; gap:10px; margin-bottom:5px;">
                            <input type="text" name="specs_keys[]" class="form-control" value="{{ $key }}" placeholder="Key (e.g. Body)">
                            <input type="text" name="specs_vals[]" class="form-control" value="{{ $val }}" placeholder="Value (e.g. Alder)">
                            <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="padding: 0 10px; line-height:1;">X</button>
                        </div>
                    @endforeach
                @endif
                
                {{-- Selalu tampilkan 1 baris kosong untuk input baru --}}
                <div class="spec-row" style="display:flex; gap:10px; margin-bottom:5px;">
                    <input type="text" name="specs_keys[]" class="form-control" placeholder="Key (e.g. Body)">
                    <input type="text" name="specs_vals[]" class="form-control" placeholder="Value (e.g. Alder)">
                    <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="padding: 0 10px; line-height:1;">X</button>
                </div>
            </div>
            <button type="button" onclick="addSpec()" style="font-size:0.8rem; margin-top:5px; color:var(--gold); background:none; border:none; cursor:pointer;">+ Add Specification</button>
        </div>

        {{-- Gambar --}}
        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="image" class="form-control" {{ isset($product) ? '' : 'required' }}>
            @if(isset($product))
                <div style="margin-top:10px;">
                    <small>Current Image:</small><br>
                    <img src="{{ asset($product->image) }}" style="max-width:150px; margin-top:5px; border:1px solid #333;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
</div>

<script>
function addSpec() {
    const container = document.getElementById('spec-container');
    const div = document.createElement('div');
    div.className = 'spec-row';
    div.style.cssText = 'display:flex; gap:10px; margin-bottom:5px;';
    div.innerHTML = `
        <input type="text" name="specs_keys[]" class="form-control" placeholder="Key (e.g. Body)">
        <input type="text" name="specs_vals[]" class="form-control" placeholder="Value (e.g. Alder)">
        <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="padding: 0 10px; line-height:1;">X</button>
    `;
    container.appendChild(div);
}
</script>
@endsection