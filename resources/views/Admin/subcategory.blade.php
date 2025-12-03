@extends('Admin.layout.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Add New Subcategory</h3>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Errors --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> Please fix:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-3">
            <label>Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Subcategory Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter Subcategory Name" required>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn" style="background-color: #97351E; color:white;">Save Subcategory</button>
    </form>

    {{-- Table --}}
    <h4>All Subcategories</h4>
    @if ($subcategories->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcategories as $index => $sub)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $sub->category->name ?? '-' }}</td>
                        <td>{{ $sub->name }}</td>
                        <td>
                            @if($sub->image)
                                <img src="{{ asset( $sub->image) }}" width="60" class="rounded-circle border">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.subcategories.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Delete this subcategory?')" class="d-inline">
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
        <p class="text-muted">No subcategories found.</p>
    @endif
</div>
@endsection
