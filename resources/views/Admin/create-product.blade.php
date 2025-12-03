@extends('Admin.layout.app')

@section('page-title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>There were some errors:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header fw-bold" style="background-color: #a43f26; color: #fff;">
        {{ isset($product) ? 'Edit Product' : 'Create Product' }}
    </div>
    <div class="card-body">
        <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($product))
                @method('PUT')
            @endif

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{ old('title', $product->title ?? '') }}" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                           value="{{ old('slug', $product->slug ?? '') }}">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="short_description" class="form-label">Short Description</label>
                    <input type="text" class="form-control" id="short_description" name="short_description"
                           value="{{ old('short_description', $product->short_description ?? '') }}">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="brand_name" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" id="brand_name" name="brand_name"
                           value="{{ old('brand_name', $product->brand_name ?? '') }}">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="category_id" class="form-label">Select Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
             
                <div class="mb-3 col-md-6">
                    <label for="year_old" class="form-label">Year Old</label>
                    <input type="number" class="form-control" id="year_old" name="year_old"
                           value="{{ old('year_old', $product->year_old ?? '') }}">
                </div>
                   <div class="mb-3 col-md-12" id="subcategory-div" style="display:none;">
    <label for="subcategory_id" class="form-label">Select Subcategory</label>
    <select name="subcategory_id" id="subcategory_id" class="form-select">
        <option value="">-- Select Subcategory --</option>
    </select>
</div>

 <div class="mb-3 col-md- 12">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price"
                           value="{{ old('price', $product->price ?? '') }}">
                </div>
                <div class="mb-3 col-md-12">
                    <label for="alcohol_percentage" class="form-label">Alcohol Percentage (%)</label>
                    <input type="text" class="form-control" id="alcohol_percentage" name="alcohol_percentage"
                           value="{{ old('alcohol_percentage', $product->alcohol_percentage ?? '') }}">
                </div>

                <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Full Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if (isset($product) && $product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100" class="mt-2 rounded">
                    @endif
                </div>
            </div>

            <button type="submit" class="btn mt-2" style="background-color: #a43f26; color: #fff;">
                {{ isset($product) ? 'Update Product' : 'Create Product' }}
            </button>
        </form>
    </div>
</div>
<script>
document.getElementById('category_id').addEventListener('change', function() {
    var categoryId = this.value;
    var subDiv = document.getElementById('subcategory-div');
    var subSelect = document.getElementById('subcategory_id');

    if(!categoryId) {
        subDiv.style.display = 'none';
        subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
        return;
    }

    fetch('/admin/category/' + categoryId + '/subcategories')
        .then(response => response.json())
        .then(data => {
            if(data.length > 0){
                subDiv.style.display = 'block';
                subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
                data.forEach(function(sub){
                    subSelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                });
            } else {
                subDiv.style.display = 'none';
                subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
            }
        });
});
</script>
@endsection
