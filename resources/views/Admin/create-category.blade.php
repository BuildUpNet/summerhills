@extends('Admin.layout.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">
        {{ isset($category) ? 'Edit Category' : 'Add New Category' }}
    </h3>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Please fix the following:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Category Form --}}
    <form
        action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="mb-5"
    >
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Category Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $category->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Category Image {{ isset($category) && $category->image ? '(Upload to change)' : '' }}</label>
            <input type="file" name="image" class="form-control">

            @if(isset($category) && $category->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="60" class="rounded-circle border">
                </div>
            @endif
        </div>

        <button type="submit" class="btn" style="background-color: #97351E; color:white;">
            {{ isset($category) ? 'Update Category' : 'Save Category' }}
        </button>

        @if(isset($category))
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
        @endif
    </form>

    {{-- Categories Table --}}
    <h4>All Categories</h4>

    @if ($categories->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categories as $index => $cat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>
                            @if($cat->image)
                                <img src="{{ asset( $cat->image) }}" width="60" class="rounded-circle border">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm" style="background-color: #97351E; color:white;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">No categories found.</p>
    @endif
</div>
@endsection
