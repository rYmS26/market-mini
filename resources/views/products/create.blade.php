@extends('master')

@section('title', 'Create Product')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required onchange="previewImage(event)">
            <small class="form-text text-muted">Recommended size: 800x600px</small>
        </div>

        <!-- Preview image before upload -->
        <div class="form-group">
            <img id="imagePreview" style="display:none; width: 100%; max-width: 300px; height: auto;" />
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
