@extends('Admin.layout.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 fw-bold text-dark">Customer List</h3>

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-white">
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th style="width:150px;">Wishlist</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}</td>
                        <td class="text-capitalize">{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone ?? 'N/A' }}</td>
                        <td class="text-capitalize">{{ $customer->role }}</td>
                        <td>
                            <button class="btn btn-sm" style="background-color: #97351E; color: white;" type="button"
                                data-bs-toggle="collapse" data-bs-target="#wishlist-{{ $customer->id }}"
                                aria-expanded="false" aria-controls="wishlist-{{ $customer->id }}">
                                View Wishlist
                            </button>
                        </td>
                    </tr>

                    <tr class="collapse" id="wishlist-{{ $customer->id }}">
                        <td colspan="6" class="p-3 bg-light">
                            @if ($customer->wishlist->count() > 0)
                                <div class="row g-3">
                                    @foreach ($customer->wishlist as $wish)
                                        @php $product = $wish->product; @endphp
                                        @if ($product)
                                            <div class="col-md-4">
                                                <div class="card h-100 shadow-sm border-0">
                                                    <img src="{{ asset($product->image) }}" class="card-img-top"
                                                        style="height:180px; object-fit:cover; border-radius: 8px 8px 0 0;">
                                                    <div class="card-body p-2">
                                                        <h6 class="card-title text-truncate">{{ $product->title }}</h6>
                                                        <p class="mb-1"><strong>Brand:</strong>
                                                            {{ $product->brand_name }}</p>
                                                        <p class="mb-1"><strong>Year:</strong> {{ $product->year_old }}
                                                        </p>
                                                        <p class="mb-1"><strong>Alcohol %:</strong>
                                                            {{ $product->alcohol_percentage }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted m-0">No wishlist products added.</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        table tbody tr:hover {
            background-color: #f9f2f0;
        }

        .card-title {
            font-weight: 600;
            font-size: 14px;
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
@endsection
