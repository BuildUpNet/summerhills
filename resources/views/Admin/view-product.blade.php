@extends('Admin.layout.app')

@section('page-title', 'View Products')

@section('content')
    <style>
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(164, 63, 38, 0.25);
            border-color: #a43f26 !important;
        }

        .btn-outline-secondary:hover {
            background-color: #a43f26;
            color: #fff !important;
            border-color: #a43f26 !important;
        }

        .pagination .page-link {
            background-color: #a43f26;
            color: #fff !important;
            border: 1px solid #a43f26;
        }

        .pagination .page-link:hover {
            background-color: #8e371f;
            color: #fff !important;
        }

        .pagination .active .page-link {
            background-color: #7a2f19 !important;
            border-color: #7a2f19 !important;
            color: #fff !important;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #c65a42;
            border-color: #c65a42;
            color: #fff !important;
        }
    </style>


    <div class="card shadow-sm border-0">
        <div class="card-header text-white fw-bold" style="background-color: #a43f26;">
            Products List
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body d-flex justify-content-start">
     <form method="GET" action="{{ route('admin.products.index') }}" 
    class="mb-3 d-flex align-items-center" style="gap:10px;">

    <input type="text" name="search" class="form-control rounded-pill"
        placeholder="🔍 Search product.." value="{{ $search ?? '' }}"
        style="width: 250px; border: 2px solid #a43f26;">

    <!-- Category filter -->
    <select name="category_id" class="form-control rounded-pill"
            style="width: 200px; border: 2px solid #a43f26;">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn text-white fw-semibold px-3"
        style="background-color: #a43f26; border-radius: 50px;">
        <i class="bi bi-search"></i> Search
    </button>

    @if (!empty($search) || !empty(request('category_id')))
        <a href="{{ route('admin.products.index') }}"
            class="btn btn-outline-secondary fw-semibold px-3 rounded-pill">
            <i class="bi bi-x-circle"></i> Clear
        </a>
    @endif
</form>


        </div>

        <div class="card-body table-responsive">


            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Brand name</th>
                        <th>Year_old</th>
                        <th>Alcohol %</th>
                        <th>Best Product</th>
                        <th>Banner Product</th>

                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $key => $product)
                        <tr>
                            <td>{{ $products->firstItem() + $key }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="Product Image" width="60"
                                        height="60" class="rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->brand_name }}</td>
                            <td>{{ $product->year_old }}</td>
                            <td>{{ $product->alcohol_percentage }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-best-product" type="checkbox"
                                        data-id="{{ $product->id }}" {{ $product->best_product ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-banner-product" type="checkbox"
                                        data-id="{{ $product->id }}" {{ $product->banner_product ? 'checked' : '' }}>
                                </div>
                            </td>

                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-best-product').on('change', function() {
                let productId = $(this).data('id');
                let isChecked = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('admin.toggleBestProduct') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId,
                        best_product: isChecked
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response
                            .message); // You can replace this with a Bootstrap alert
                        } else {
                            alert('Something went wrong.');
                        }
                    },
                    error: function() {
                        alert('Server error. Please try again.');
                    }
                });
            });
        });
        $(document).ready(function() {
            // Existing best product toggle...

            $('.toggle-banner-product').on('change', function() {
                let productId = $(this).data('id');
                let isChecked = $(this).is(':checked') ? 1 : 0;
                let checkbox = $(this);

                $.ajax({
                    url: "{{ route('admin.toggleBannerProduct') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId,
                        banner_product: isChecked
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                            // Uncheck if the limit exceeded
                            checkbox.prop('checked', false);
                        }
                    },
                    error: function() {
                        alert('Server error. Please try again.');
                        checkbox.prop('checked', !isChecked);
                    }
                });
            });
        });
    </script>

@endsection
