@extends('Admin.layout.app')
@section('content')
<div class="container-fluid py-4" style="background: #f5f7fa; min-height: 100vh;">

    <div class="row g-4">
        <!-- Total Products -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 h-100 d-flex card-hover">
                <div class="icon-sidebar bg-warning d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-seam fs-2 text-white"></i>
                </div>
                <div class="card-content p-3 flex-grow-1 d-flex flex-column justify-content-center">
                    <h6 class="text-muted mb-1">Total Products</h6>
                    <h2 class="fw-bold mb-2">{{ $totalProducts }}</h2>
                    <div class="progress-bar-container">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ min($newProductsThisWeek ?? 0, 100) }}%" aria-valuenow="{{ $newProductsThisWeek ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-success mt-1">+{{ $newProductsThisWeek ?? 0 }} this week</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 h-100 d-flex card-hover">
                <div class="icon-sidebar bg-primary d-flex align-items-center justify-content-center">
                    <i class="bi bi-tags fs-2 text-white"></i>
                </div>
                <div class="card-content p-3 flex-grow-1 d-flex flex-column justify-content-center">
                    <h6 class="text-muted mb-1">Total Categories</h6>
                    <h2 class="fw-bold mb-2">{{ $totalCategories }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 h-100 d-flex card-hover">
                <div class="icon-sidebar bg-danger d-flex align-items-center justify-content-center">
                    <i class="bi bi-people fs-2 text-white"></i>
                </div>
                <div class="card-content p-3 flex-grow-1 d-flex flex-column justify-content-center">
                    <h6 class="text-muted mb-1">Total Users</h6>
                    <h2 class="fw-bold mb-2">{{ $totalUsers }}</h2>
                    <div class="progress-bar-container">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ min($newUsersToday ?? 0, 100) }}%" aria-valuenow="{{ $newUsersToday ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-info mt-1">+{{ $newUsersToday ?? 0 }} today</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wishlist Products -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 h-100 d-flex card-hover">
                <div class="icon-sidebar bg-success d-flex align-items-center justify-content-center">
                    <i class="bi bi-heart fs-2 text-white"></i>
                </div>
                <div class="card-content p-3 flex-grow-1 d-flex flex-column justify-content-center">
                    <h6 class="text-muted mb-1">Wishlist</h6>
                    <h2 class="fw-bold mb-2">{{ $totalWishlistProducts }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.card-hover {
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    background-color: #fff;
    cursor: default;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.18);
    cursor: pointer;
}

/* Left icon sidebar */
.icon-sidebar {
    width: 90px;
    min-width: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    color: #fff;
}

/* Card content */
.card-content h6 {
    font-size: 0.9rem;
    letter-spacing: 0.6px;
    margin-bottom: 5px;
    color: #6c757d;
}
.card-content h2 {
    font-size: 2.2rem;
    margin-bottom: 0;
    color: #212529;
}

/* Progress bar */
.progress-bar-container {
    margin-top: 8px;
    max-width: 130px;
}
.progress {
    border-radius: 4px;
    background: #e9ecef;
}
.progress-bar {
    border-radius: 4px;
}

/* Responsive */
@media (max-width: 767px) {
    .card-hover {
        flex-direction: column;
        text-align: center;
    }
    .icon-sidebar {
        width: 100%;
        min-width: 100%;
        padding: 20px 0;
        font-size: 48px;
    }
    .card-content {
        padding: 15px 10px;
    }
}


/* Progress bar */
.progress-bar-container {
    margin-top: 8px;
    max-width: 130px;
}
.progress {
    border-radius: 4px;
    background: #e9ecef;
}
.progress-bar {
    border-radius: 4px;
}

/* Responsive */
@media (max-width: 767px) {
    .card-hover {
        flex-direction: column;
        text-align: center;
    }
    .icon-sidebar {
        width: 100%;
        min-width: 100%;
        padding: 15px 0;
        font-size: 36px;
    }
    .card-content {
        padding: 15px 10px;
    }
}
</style>
@endsection
