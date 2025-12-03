@extends('layout.main')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .profile-section {
            padding: 40px 0;
            background-color: #f9f9f9;
        }

        .profile-layout {
            display: flex;
            gap: 30px;
            max-width: 1200px;
            margin: auto;
        }

        /* Sidebar */
        .profile-sidebar {
            width: 300px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .profile-card {
            text-align: center;
        }

        .profile-avatar {
            position: relative;
            margin-bottom: 15px;
        }

        .user-avatar-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
        }

        .avatar-edit {
            position: absolute;
            bottom: 0;
            right: 5px;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 6px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 14px;
        }

        .avatar-edit:hover {
            background-color: #0056b3;
        }

        .profile-info h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .profile-email {
            font-size: 14px;
            color: #666;
        }

        .profile-type {
            display: inline-block;
            margin-top: 8px;
            background-color: #e1f0ff;
            color: #007bff;
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 12px;
        }

        /* Stats */
        .profile-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-weight: bold;
            font-size: 18px;
        }

        .stat-label {
            font-size: 12px;
            color: #777;
        }

        /* Menu */
        .profile-menu {
            margin-top: 20px;
        }

        .menu-item {
            display: block;
            width: 100%;
            padding: 12px 15px;
            border: none;
            background: none;
            text-align: left;
            font-size: 14px;
            color: #444;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.2s ease;
        }

        .menu-item i {
            margin-right: 8px;
        }

        .menu-item.active,
        .menu-item:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Main Content */
        .profile-content {
            flex: 1;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .content-header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .content-header p {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        /* Tab Panels */
        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        /* Forms */
        .profile-form .form-section {
            margin-bottom: 30px;
        }

        .profile-form h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Wishlist & Reviews */
        .wishlist-list,
        .reviews-list {
            list-style: none;
            padding-left: 0;
        }

        .wishlist-item,
        .review-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .review-item h4 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .review-item .rating {
            font-size: 14px;
            color: #f39c12;
        }

        .review-item small {
            color: #777;
            font-size: 12px;
        }
    </style>

    <!--<section class="hero-wrap hero-wrap-2"-->
    <!--    style="background-image: url('{{ $settings && $settings->banner_image ? asset($settings->banner_image) : asset('assets/images/default_banner.jpg') }}');"-->
    <!--    data-stellar-background-ratio="0.5">-->
    <!--    <div class="overlay"></div>-->
    <!--    <div class="container">-->
    <!--        <div class="row no-gutters slider-text align-items-end justify-content-center">-->
    <!--            <div class="col-md-9 ftco-animate mb-5 text-center">-->
    <!--                <p class="breadcrumbs mb-0">-->
    <!--                    <span class="mr-2"><a href="{{ route('home') }}">Home <i class="fa fa-chevron-right"></i></a></span>-->
    <!--                    <span>My Account <i class="fa fa-chevron-right"></i></span>-->
    <!--                </p>-->
    <!--                <h2 class="mb-0 bread" data-anim="fade-down">My Account</h2>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    
    {{-- 1. Hero/Header Section: Clean, Centered Title --}}
    <section class="hero-wrap hero-wrap-2 d-flex align-items-center justify-content-center py-5" 
        style="background-image: url('{{ $settings && $settings->banner_image ? asset($settings->banner_image) : asset('assets/images/default_banner.jpg') }}'); min-height: 350px; background-size: cover; background-position: center;">
        
        {{-- Use the overlay styling from the CSS, but apply a darker one for header visibility --}}
        <div class="hero-overlay-2" ></div> 
        <div class="container py-5 text-center position-relative" style="z-index: 2;">
            <div class="col-md-12 text-center text-white" data-aos="fade-up" data-aos-duration="1000">
                
                {{-- Breadcrumbs in light text --}}
                <p class="breadcrumbs mb-3  fw-normal text-white-50 fs-5">
                    <span class="me-2"><a href="/" class="text-decoration-none text-white">Home<i class="fa fa-chevron-right "></i></a></span>/ 
                    <span class="text-white-75">My Account </span>
                </p>
                
                {{-- Main Heading --}}
                <h1 class="display-3 fw-bold mb-0 text-white" style="font-family: var(--heading-font-family);">
                    My Account
                </h1>
            </div>
        </div>
    </section>

    <section class="profile-section">
        <div class="container">
            <div class="profile-layout">
                {{-- Sidebar --}}
                <div class="profile-sidebar">
                    <div class="profile-card">
                        <div class="profile-avatar">
                            @auth
                                @if (auth()->user()->profile_image)
                                    <img src="{{ asset(auth()->user()->profile_image) }}" alt="Profile Image"
                                        class="user-avatar-img">
                                @else
                                    <div class="avatar-3d">
                                        <div class="avatar-face"></div>
                                        <div class="avatar-hair"></div>
                                        <div class="avatar-lab-coat"></div>
                                    </div>
                                @endif
                            @endauth

                            <input type="file" name="profile_image" id="avatar-upload" hidden>

                        </div>

                        <div class="profile-info">
                            @auth
                                <h2>{{ auth()->user()->name }}</h2>
                                <p class="profile-email">{{ auth()->user()->email }}</p>
                            @endauth
                            <span class="profile-type">User</span>
                        </div>

                        <div class="profile-stats">
                            <div class="stat">
                                <span class="stat-number">{{ $wishlistCount }}</span>
                                <span class="stat-label">WishList Product</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number">{{ $reviewsCount ?? 0 }}</span>
                                <span class="stat-label">Reviews</span>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Tabs Menu -->
                    <div class="profile-menu">
                        <button type="button" class="menu-item active" data-tab="personal">
                            <i class="fa fa-user"></i> Personal Info
                        </button>
                        <button type="button" class="menu-item" data-tab="wishlist">
                            <i class="fa fa-heart"></i> Wishlist
                        </button>
                        <button type="button" class="menu-item" data-tab="reviews">
                            <i class="fa fa-star"></i> Reviews
                        </button>
                        <button type="button" class="menu-item" data-tab="password">
                            <i class="fa fa-lock"></i> Change Password
                        </button>
                    </div>

                </div>

                {{-- Main Content --}}
                <div class="profile-content">
                    <div class="content-header">
                        <h1>My Account</h1>
                        <p>Manage your details, wishlist, and reviews here</p>
                    </div>

                    <div class="tab-content">
                        <div class="tab-panel active" id="personal-panel">
                            <form class="profile-form" method="POST" action="{{ route('account.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-section">
                                    <h3>Basic Information</h3>

                                    <div class="form-group">
                                        <label for="profile_image">Profile Picture</label>
                                        <input type="file" name="profile_image" id="profile_image">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ old('email', auth()->user()->email) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" name="phone" id="phone"
                                                value="{{ old('phone', auth()->user()->phone) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn" style="background-color: var(--primary-color); color:black;"><i
                                            class="fa fa-save"></i> Save Changes</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>

                        
                    <div class="tab-panel" id="wishlist-panel">
                        <div class="form-section">
                            <h3>My Wishlist</h3>
    
     @if($wishlist->count() > 0)
<div class="table-responsive mt-4">
  <table class="table table-bordered align-middle text-center">
    <thead class="table-light">
      <tr>
        <th>Image</th>
        <th>Product Title</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($wishlist as $item)
      <tr id="wishlist-row-{{ $item->product->id }}">
        <td style="width: 120px;">
          <img 
            src="{{ asset($item->product->image) }}" 
            alt="{{ $item->product->title }}" 
            class="img-fluid rounded" 
            style="max-width: 80px; height: 80px; object-fit: cover;"
          >
        </td>
        <td class="fw-semibold text-start">
          {{ $item->product->title }}
        </td>
        <td>
          ₹{{ number_format($item->product->price, 2) }}
        </td>
        <td>
          <a href="{{ route('products.single', $item->product->slug) }}" 
             class="btn btn-sm btn-outline-primary">View</a>

          <button 
            class="btn btn-sm btn-outline-danger remove-wishlist" 
            data-product-id="{{ $item->product->id }}">
            Remove
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
  <p class="text-muted text-center my-4">No products in your wishlist yet.</p>
@endif

 
                        </div>
                    </div>

                        {{-- Reviews --}}
                        <div class="tab-panel" id="reviews-panel">
                            <div class="form-section">
                                <h3>My Reviews</h3>

                                @if ($reviews && $reviews->count())
                                    <ul class="reviews-list">
                                        @foreach ($reviews as $review)
                                            <li class="review-item">
                                                {{-- Product Name --}}
                                                <h4>
                                                    @if ($review->product)
                                                        <a href="">
                                                            {{ $review->product->title }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">[Product not found]</span>
                                                    @endif
                                                </h4>

                                                {{-- Rating --}}
                                                <div class="rating">Rating: {{ $review->rating }} / 5</div>

                                                {{-- Comment --}}
                                                <p>{{ $review->comment }}</p>
                                                <small>{{ $review->created_at->diffForHumans() }}</small>
                                                <form action="" method="POST"
                                                    style="display:inline-block; margin-top: 5px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this review?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>You have not posted any reviews yet.</p>
                                @endif
                            </div>
                        </div>

                        {{-- Change Password --}}

                        <div class="tab-panel" id="password-panel">
                            <div class="form-section">
                                <h3>Change Password</h3>

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('account.update.password') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" name="current_password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" name="password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" required>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn " style="background-color: var(--primary-color); color:black;">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- End of Tabs --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuButtons = document.querySelectorAll(".menu-item");
            const tabPanels = document.querySelectorAll(".tab-panel");

            menuButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const selectedTab = this.getAttribute("data-tab");
                    const targetPanel = document.getElementById(selectedTab + "-panel");

                    // Remove active from all
                    menuButtons.forEach(btn => btn.classList.remove("active"));
                    tabPanels.forEach(panel => panel.classList.remove("active"));

                    // Activate selected
                    this.classList.add("active");
                    if (targetPanel) {
                        targetPanel.classList.add("active");
                    }
                });
            });
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
  const removeButtons = document.querySelectorAll('.remove-wishlist');

  removeButtons.forEach(button => {
    button.addEventListener('click', function() {
      const productId = this.dataset.productId;
      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      Swal.fire({
        title: 'Remove from wishlist?',
        text: "This product will be removed from your wishlist.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, remove it'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`/wishlist/remove/${productId}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': token,
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
          })
          .then(response => response.json())
          .then(data => {
            Swal.fire({
              icon: 'success',
              title: 'Removed!',
              text: data.success || 'Product removed from wishlist',
              timer: 1500,
              showConfirmButton: false
            });
            
            // Reload same tab after short delay
            setTimeout(() => {
              window.location.reload();
            }, 1600);
          })
          .catch(error => console.error('Error removing from wishlist:', error));
        }
      });
    });
  });
});
</script>

@endsection
