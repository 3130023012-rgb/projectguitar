@extends('admin.layout')

@section('content')
<div class="header">
    <h2>Home Page Content</h2>
</div>

<div class="card">
    <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Hero Section -->
        <h4 style="margin-bottom:20px; color:var(--gold); border-bottom:1px solid #333; padding-bottom:10px;">Hero Section</h4>
        <div class="form-group">
            <label>Title Line 1</label>
            <input type="text" name="hero_title_1" class="form-control" value="{{ $settings['hero_title_1'] ?? '' }}">
        </div>
        <div class="form-group">
            <label>Title Line 2 (Highlighted)</label>
            <input type="text" name="hero_title_2" class="form-control" value="{{ $settings['hero_title_2'] ?? '' }}">
        </div>
        <div class="form-group">
            <label>Subtitle</label>
            <textarea name="hero_subtitle" class="form-control">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
        </div>

        <hr style="border-color:#333; margin:30px 0;">

        <!-- About Section -->
        <h4 style="margin-bottom:20px; color:var(--gold); border-bottom:1px solid #333; padding-bottom:10px;">About Section</h4>
        <div class="form-group">
            <label>About Title</label>
            <input type="text" name="about_title" class="form-control" value="{{ $settings['about_title'] ?? '' }}">
        </div>
        <div class="form-group">
            <label>About Text</label>
            <textarea name="about_text" class="form-control" rows="5">{{ $settings['about_text'] ?? '' }}</textarea>
        </div>
        
        <!-- Upload Gambar About -->
        <div class="form-group">
            <label>About Image</label>
            <input type="file" name="about_image" class="form-control">
            @if(isset($settings['about_image']))
                <div style="margin-top:10px;">
                    <small>Current Image:</small><br>
                    <img src="{{ asset($settings['about_image']) }}" style="max-width:200px; margin-top:5px; border:1px solid #333;">
                </div>
            @endif
        </div>

        <hr style="border-color:#333; margin:30px 0;">

        <!-- Release Ars Section -->
        <h4 style="margin-bottom:20px; color:var(--gold); border-bottom:1px solid #333; padding-bottom:10px;">Release Ars Section (3 Items)</h4>
        
        <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:20px;">
            @php $i = 1; @endphp
            
            <!-- Item 1 -->
            <div style="background:#111; padding:15px; border:1px solid #222;">
                <h5 style="color:#fff; margin-bottom:15px;">Item 1</h5>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="release_title_1" class="form-control" value="{{ $settings['release_title_1'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Tag (e.g. NEW)</label>
                    <input type="text" name="release_tag_1" class="form-control" value="{{ $settings['release_tag_1'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="release_image_1" class="form-control">
                    @if(isset($settings['release_image_1']))
                        <img src="{{ asset($settings['release_image_1']) }}" style="max-width:100%; margin-top:5px;">
                    @endif
                </div>
            </div>

            <!-- Item 2 -->
            <div style="background:#111; padding:15px; border:1px solid #222;">
                <h5 style="color:#fff; margin-bottom:15px;">Item 2</h5>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="release_title_2" class="form-control" value="{{ $settings['release_title_2'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Tag</label>
                    <input type="text" name="release_tag_2" class="form-control" value="{{ $settings['release_tag_2'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="release_image_2" class="form-control">
                    @if(isset($settings['release_image_2']))
                        <img src="{{ asset($settings['release_image_2']) }}" style="max-width:100%; margin-top:5px;">
                    @endif
                </div>
            </div>

            <!-- Item 3 -->
            <div style="background:#111; padding:15px; border:1px solid #222;">
                <h5 style="color:#fff; margin-bottom:15px;">Item 3</h5>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="release_title_3" class="form-control" value="{{ $settings['release_title_3'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Tag</label>
                    <input type="text" name="release_tag_3" class="form-control" value="{{ $settings['release_tag_3'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="release_image_3" class="form-control">
                    @if(isset($settings['release_image_3']))
                        <img src="{{ asset($settings['release_image_3']) }}" style="max-width:100%; margin-top:5px;">
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Save Changes</button>
    </form>
</div>
@endsection