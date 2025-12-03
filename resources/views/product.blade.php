@extends('layout.main')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
:root {
  --products-primary-color: #f76b00;
  --products-primary-darker: #e06000;
  --products-dark-color: #333;
  --products-body-text-color: #555;
  --products-light-bg-color: #f8f9fa;
  --products-font-family: 'Roboto', sans-serif;
  --products-heading-font-family: 'Roboto Slab', serif;
  --products-border-radius: 12px;
}

body { 
  font-family: var(--products-font-family); 
  color: var(--products-body-text-color); 
}

h1,h2,h3,h4,h5,h6 { 
  font-family: var(--products-heading-font-family); 
  color: var(--products-dark-color); 
}

/* Remove blue underline from all links */
.products-page-wrapper a {
  text-decoration: none !important;
}

.products-page-wrapper a:hover {
  text-decoration: none !important;
}

/* Button Styles */
.products-btn-custom-orange,
#productsApplyFiltersBtnMobile {
  background-color: var(--products-primary-color);
  color: white;
  border-radius: var(--products-border-radius);
  transition: all 0.3s;
  font-weight: bold;
  border: none;
  padding: 12px 28px;
  text-decoration: none !important;
}

.products-btn-custom-orange:hover,
#productsApplyFiltersBtnMobile:hover {
  background-color: var(--products-primary-darker);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(247, 107, 0, 0.3);
  color: white;
  text-decoration: none !important;
}

/* Filter Sidebar - Sticky with proper height */
/*.products-filter-sidebar-wrapper {*/
/*  position: relative;*/
/*  height: fit-content;*/
/*}*/

/*.products-filter-sidebar-content {*/
/*  position: sticky;*/
/*  top: 80px;*/
/*  background: white;*/
/*  border-radius: var(--products-border-radius);*/
/*  padding: 0;*/
/*  box-shadow: 0 2px 8px rgba(0,0,0,0.08);*/
  
/*  overflow-y: auto;*/
/*  -ms-overflow-style: none;*/
/*  scrollbar-width: thin;*/
/*  scrollbar-color: var(--products-primary-color) #f0f0f0;*/
/*}*/

/*.products-filter-sidebar-content::-webkit-scrollbar { */
/*  width: 6px;*/
/*}*/
/* Filter Sidebar - Sticky with proper height */
.products-filter-sidebar-wrapper {
  position: relative;
  height: auto;
}

.products-filter-sidebar-content {
  position: sticky;
  top: 80px;
  
  background: white;
  border-radius: var(--products-border-radius);
  padding: 0;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  
  overflow-y: auto;
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.products-filter-sidebar-content::-webkit-scrollbar { 
  display: none;
}


.products-filter-sidebar-content::-webkit-scrollbar-track {
  background: #f0f0f0;
  border-radius: 10px;
}

.products-filter-sidebar-content::-webkit-scrollbar-thumb {
  background: var(--products-primary-color);
  border-radius: 10px;
}

.products-filter-sidebar-content::-webkit-scrollbar-thumb:hover {
  background: var(--products-primary-darker);
}

/* Filter Header */
.products-filter-header {
  padding: 20px 24px;
  border-bottom: 2px solid #f0f0f0;
  position: sticky;
  top: 0;
  background: white;
  z-index: 10;
  border-radius: var(--products-border-radius) var(--products-border-radius) 0 0;
}

.products-filter-header h4 {
  margin: 0;
  font-size: 1.25rem;
  color: var(--products-dark-color);
}

/* Filter Body */
.products-filter-body {
  padding: 20px 24px;
}

/* Filter Section */
.products-filter-section {
  margin-bottom: 24px;
  padding-bottom: 24px;
  border-bottom: 1px solid #e9ecef;
}

.products-filter-section:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.products-filter-section-title {
  font-size: 1rem;
  font-weight: 600;
  color: var(--products-dark-color);
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  user-select: none;
  padding: 8px 0;
}

.products-filter-section-title i {
  transition: transform 0.3s ease;
  color: var(--products-primary-color);
  font-size: 0.9rem;
}

.products-filter-section-title.collapsed i {
  transform: rotate(-90deg);
}

.products-filter-section-content {
  max-height: 400px;
  overflow: visible;
  transition: max-height 0.3s ease;
}

.products-filter-section-content.collapse:not(.show) {
  max-height: 0;
  overflow: hidden;
}

/* Form Controls */
.products-page-wrapper .form-check {
  margin-bottom: 10px;
  padding-left: 1.75rem;
}

.products-page-wrapper .form-check-input {
  margin-top: 0.15rem;
  cursor: pointer;
}

.products-page-wrapper .form-check-label {
  cursor: pointer;
  font-size: 0.95rem;
  color: var(--products-body-text-color);
}

.products-page-wrapper .form-check-input:checked {
  background-color: var(--products-primary-color);
  border-color: var(--products-primary-color);
}

.products-page-wrapper .form-check-input:focus {
  box-shadow: 0 0 0 0.25rem rgba(247, 107, 0, 0.25);
  border-color: var(--products-primary-color);
}

.products-page-wrapper .form-select {
  cursor: pointer;
  font-size: 0.95rem;
}

.products-page-wrapper .form-select:focus {
  border-color: var(--products-primary-color);
  box-shadow: 0 0 0 0.25rem rgba(247, 107, 0, 0.25);
}

/* Subcategory Styling */
.products-subcategory-wrapper {
  margin-left: 20px;
  padding-left: 16px;
  border-left: 2px solid #e9ecef;
  margin-top: 8px;
}

.products-subcategory-wrapper .form-check {
  margin-bottom: 8px;
}

.products-subcategory-wrapper .form-check-label {
  font-size: 0.9rem;
  color: #6c757d;
}

/* Product Card - Enhanced */
.products-product-card {
  border: 1px solid #e9ecef;
  border-radius: var(--products-border-radius);
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  display: flex;
  flex-direction: column;
  background: white;
  position: relative;
  height: 100%;
  text-decoration: none !important;
}

.products-product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.15);
  border-color: var(--products-primary-color);
}

/* Product Image Container - Edge to Edge with Proper Aspect Ratio */
.products-product-image-container {
  position: relative;
  width: 100%;
  padding-top: 100%; /* 1:1 Aspect Ratio */
  overflow: hidden;
  background: #fafafa;
}

.products-product-image-container img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.products-product-card:hover .products-product-image-container img {
  transform: scale(1.05);
}

/* Wishlist Icon - Over Image */
.products-wishlist-icon {
  position: absolute;
  top: 12px;
  right: 12px;
  z-index: 3;
  background: rgba(255, 255, 255, 0.95);
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
  backdrop-filter: blur(4px);
}

.products-wishlist-icon:hover {
  transform: scale(1.15);
  box-shadow: 0 4px 12px rgba(0,0,0,0.25);
  background: white;
}

.products-wishlist-icon i {
  color: var(--products-primary-color);
  font-size: 18px;
}

.products-wishlist-icon i.products-wishlisted {
  color: #dc3545;
}

/* Hover Overlay */
.products-hover-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.88);
  opacity: 0;
  transition: opacity 0.4s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  z-index: 2;
}

.products-product-card:hover .products-hover-overlay {
  opacity: 1;
}

.products-hover-content {
  text-align: center;
  color: white;
}

.products-hover-content h6 {
  color: white;
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 12px;
  line-height: 1.3;
}

.products-hover-content .products-hover-detail {
  font-size: 0.9rem;
  margin-bottom: 6px;
  color: rgba(255,255,255,0.95);
  line-height: 1.4;
}

.products-hover-content .products-hover-detail strong {
  color: var(--products-primary-color);
  font-weight: 600;
}

.products-hover-content .products-btn-explore {
  margin-top: 18px;
  background: var(--products-primary-color);
  color: white;
  padding: 11px 26px;
  border-radius: 8px;
  border: none;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-block;
  text-decoration: none !important;
  font-size: 0.95rem;
}

.products-hover-content .products-btn-explore:hover {
  /*background: var(--products-primary-darker);*/
    background: var(--products-primary-color);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(247, 107, 0, 0.5);
  color: white;
  text-decoration: none !important;
}

/* Product Card Content */
.products-card-body {
  padding: 16px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.products-product-card .products-category-text {
  font-size: 0.8rem;
  color: var(--products-primary-color);
  text-transform: uppercase;
  font-weight: 600;
  margin-bottom: 6px;
  letter-spacing: 0.5px;
}

.products-product-card h6 {
  color: var(--products-dark-color);

  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 8px;
  line-height: 1.4;
  min-height: 44px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}





.products-product-card .products-price-text {
  color: var(--products-primary-color);
  font-size: 1.25rem;
  font-weight: 700;
  margin: 0;
}

/* Mobile Filter Button */
#productsFilterBtnMobile {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
  background: var(--products-primary-color);
  color: white;
  border: none;
  border-radius: 50px;
  padding: 16px 32px;
  font-weight: bold;
  box-shadow: 0 4px 16px rgba(247, 107, 0, 0.4);
  transition: all 0.3s ease;
}

#productsFilterBtnMobile:hover {
  background: var(--products-primary-darker);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(247, 107, 0, 0.5);
}

/* Filter Modal */
#productsFilterModal .modal-content {
  border-radius: var(--products-border-radius);
  max-height: 90vh;
}

#productsFilterModal .modal-header {
  background: var(--products-primary-color);
  color: white;
  border-radius: var(--products-border-radius) var(--products-border-radius) 0 0;
}

#productsFilterModal .modal-header .btn-close {
  filter: brightness(0) invert(1);
}

#productsFilterModal .modal-body {
  max-height: calc(90vh - 140px);
  overflow-y: auto;
}

/* Desktop: 3 cards per row */
@media (min-width: 992px) {
  .products-grid-container .col-products {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
}

/* Tablet: 2 cards per row */
@media (min-width: 768px) and (max-width: 991px) {
  .products-grid-container .col-products {
    flex: 0 0 50%;
    max-width: 50%;
  }
  
  #productsFilterBtnMobile {
    display: block;
  }
  
  .products-sidebar-desktop {
    display: none !important;
  }
}

/* Mobile: 2 cards per row */
@media (max-width: 767px) {
  .products-grid-container .col-products {
    flex: 0 0 50%;
    max-width: 50%;
  }
  
  #productsFilterBtnMobile {
    display: block;
  }
  
  .products-sidebar-desktop {
    display: none !important;
  }
  
  .products-product-card h6 {
    font-size: 0.9rem;
    min-height: 38px;
  }
  
  .products-product-card .products-price-text {
    font-size: 1.1rem;
  }
  
  .products-card-body {
    padding: 12px;
  }
  
  .products-hover-content h6 {
    font-size: 0.95rem;
  }
  
  .products-hover-content .products-hover-detail {
    font-size: 0.85rem;
  }
}

/* Very Small Mobile */
@media (max-width: 480px) {
  .products-product-card h6 {
    font-size: 0.85rem;
    min-height: 36px;
  }
  
  .products-product-card .products-price-text {
    font-size: 1rem;
  }
  
  .products-hover-content h6 {
    font-size: 0.9rem;
  }
  
  .products-hover-content .products-hover-detail {
    font-size: 0.8rem;
    margin-bottom: 4px;
  }
  
  .products-hover-content .products-btn-explore {
      margin-top: 2px;
    padding: 9px 20px;
    font-size: 0.9rem;
  }
}

.products-pagination-wrapper .pagination {
    margin-top: 12px;
     display: flex !important;      
    justify-content: center !important; 
  
}

.products-pagination-wrapper .pagination .page-link {
    color: var(--products-primary-color);
    border-color: var(--products-primary-color); 
}

/* Active page link */
.products-pagination-wrapper .pagination .page-item.active .page-link {
    background-color:  var(--products-primary-color);
    border-color: var(--products-primary-color);
    color: #fff; 
}


.products-pagination-wrapper .pagination .page-link:hover {
    background-color:  var(--products-primary-color);
    border-color:  var(--products-primary-color);
    color: #fff; 
}


.products-pagination-wrapper .pagination .page-link:focus {
    box-shadow: none;
}


</style>

<div class="products-page-wrapper">
  <!-- Hero Section -->
  <!--<section class="hero-wrap hero-wrap-2 d-flex align-items-center justify-content-center py-5"-->
  <!--  style="background-image: url('{{ $settings && $settings->banner_image ? asset($settings->banner_image) : asset('assets/images/default_banner.jpg') }}');-->
  <!--  min-height: 350px; background-size: cover; background-position: center;">-->
  <!--  <div class="overlay" style="background-color: rgba(0, 0, 0, 0.75);"></div>-->
  <!--  <div class="container text-center text-white position-relative" style="z-index: 2;">-->
  <!--    <p class="breadcrumbs mb-3 fw-normal text-white-50 fs-5">-->
  <!--      <a href="/" class="text-decoration-none text-white">Home <i class="fa fa-chevron-right"></i></a> /-->
  <!--      <span>Products</span>-->
  <!--    </p>-->
  <!--    <h1 class="display-3 fw-bold text-white" data-anim="fade-down">The Exclusive Collection</h1>-->
  <!--  </div>-->
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
                    <span class="text-white-75">Products</span>
                </p>
                
                {{-- Main Heading --}}
                <h1 class="display-3 fw-bold mb-0 text-white" style="font-family: var(--heading-font-family);">
                    The Exclusive Collection
                </h1>
            </div>
        </div>
    </section>


  <!-- Products Section -->
  <section class="ftco-section py-5" style="background-color: var(--products-light-bg-color);">
    <div class="container-fluid">
      <div class="row g-4">
        
        <!-- Desktop Sidebar -->
        <div class="col-lg-3 products-sidebar-desktop py-3">
          <div class="products-filter-sidebar-wrapper">
            <div class="products-filter-sidebar-content">
              <!-- Filter Header -->
              <div class="products-filter-header">
                <h4>Filter & Sort</h4>
              </div>

              <!-- Filter Body -->
              <div class="products-filter-body">
                <!-- Sort Section -->
                <div class="products-filter-section">
                  <div class="products-filter-section-title" data-bs-toggle="collapse" data-bs-target="#sortCollapse">
                    <span>Sort By</span>
                    <i class="bi bi-chevron-down"></i>
                  </div>
                  <div class="products-filter-section-content collapse show" id="sortCollapse">
                    <select class="form-select products-filter-trigger" id="productsSortOrder">
                      <option value="featured" {{ request('sort') == 'featured' || !request('sort') ? 'selected' : '' }}>Featured</option>
                      <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                      <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                      <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    </select>
                  </div>
                </div>

                <!-- Product Types Section -->
                <div class="products-filter-section">
                  <div class="products-filter-section-title" data-bs-toggle="collapse" data-bs-target="#categoryCollapse">
                    <span>Product Types</span>
                    <i class="bi bi-chevron-down"></i>
                  </div>
                  <div class="products-filter-section-content collapse show" id="categoryCollapse">
                    @php $selectedCategories = explode(',', request('categories', '')); @endphp
                    @foreach($productCategories as $category)
                      <div class="form-check">
                        <input class="form-check-input products-filter-category-item products-filter-trigger"
                          type="checkbox"
                          value="{{ $category->name }}"
                          id="productsCat{{ $category->id }}"
                          {{ in_array($category->name, $selectedCategories) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="productsCat{{ $category->id }}">
                          {{ $category->name }}
                        </label>
                      </div>

                      @if($category->subcategories->count())
                        <div class="products-subcategory-wrapper">
                          @foreach($category->subcategories as $sub)
                            <div class="form-check">
                              <input class="form-check-input products-filter-category-item products-filter-trigger"
                                type="checkbox"
                                value="{{ $sub->name }}"
                                id="productsSubCat{{ $sub->id }}"
                                {{ in_array($sub->name, $selectedCategories) ? 'checked' : '' }}>
                              <label class="form-check-label" for="productsSubCat{{ $sub->id }}">{{ $sub->name }}</label>
                            </div>
                          @endforeach
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>

                <!-- Year / Age Section -->
                @php
                  $selectedAges = explode(',', request('age', ''));
                  $ages = ['12 Years', '18+ Years', 'Vintage Wine', 'Other'];
                @endphp
                <div class="products-filter-section">
                  <div class="products-filter-section-title" data-bs-toggle="collapse" data-bs-target="#ageCollapse">
                    <span>Year / Age (Y.O.)</span>
                    <i class="bi bi-chevron-down"></i>
                  </div>
                  <div class="products-filter-section-content collapse show" id="ageCollapse">
                    @foreach($ages as $age)
                      <div class="form-check">
                        <input class="form-check-input products-filter-age-item products-filter-trigger" type="checkbox"
                               value="{{ $age }}" id="productsAge{{ Str::slug($age) }}"
                               {{ in_array($age, $selectedAges) ? 'checked' : '' }}>
                        <label class="form-check-label" for="productsAge{{ Str::slug($age) }}">{{ $age }}</label>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product Grid -->
        <div class="col-lg-9 py-3">
          <div class="row g-3 products-grid-container" id="productsProductGrid">
            @forelse($products as $product)
              <div class="col-products d-flex">
                <div class="products-product-card w-100">
                  <div class="products-product-image-container">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" loading="lazy">
                    
                   <form class="wishlist-form d-inline products-wishlist-icon">
  @csrf
  @php
    $isWishlisted = isset($wishlistIds) && in_array($product->id, $wishlistIds);
  @endphp

  <button 
      type="button" 
      class="btn btn-link text-decoration-none p-0 m-2 add-to-wishlist" 
      data-product-id="{{ $product->id }}" 
      title="{{ $isWishlisted ? 'Remove from wishlist' : 'Add to wishlist' }}"
      style="color: {{ $isWishlisted ? '#e63946' : '#24a1db' }};">
      <i class="bi {{ $isWishlisted ? 'bi-heart-fill' : 'bi-heart' }} wishlist-icon"></i>
  </button>
</form>

                    
                    <!-- Hover Overlay -->
                    <div class="products-hover-overlay">
                      <div class="products-hover-content">
                        <h6 style="color:white;">{{ $product->title }}</h6>
                        <div class="products-hover-detail"><strong>Category:</strong> {{ $product->category->name ?? 'Product' }}</div>
                        <div class="products-hover-detail"><strong>Alcohol:</strong> {{ $product->alcohol_percentage ?? 'N/A' }}%</div>
                        <div class="products-hover-detail"><strong>Age:</strong> {{ $product->year_old ?? 'N/A' }} Years</div>
                        <a href="{{ route('products.single', $product->slug) }}" class="products-btn-explore">
                          Explore <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  
                  <div class="products-card-body">
                    <p class="products-category-text">{{ $product->category->name ?? 'Product' }}</p>
                    <h6>{{ $product->title }}</h6>
                    <div class="mt-auto">
                      <p class="products-price-text">${{ number_format($product->price, 2) }}</p>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12 text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No products found.</p>
              </div>
            @endforelse
          </div>

          <!-- Pagination -->
          <div class="row products-pagination-wrapper">
            <div class="col text-center">
           {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Mobile Filter Button -->
  <button id="productsFilterBtnMobile" type="button">
    <i class="bi bi-funnel-fill me-2"></i> Filters
  </button>

  <!-- Filter Modal for Mobile/Tablet -->
  <div class="modal fade" id="productsFilterModal" tabindex="-1" aria-labelledby="productsFilterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productsFilterModalLabel">Filter & Sort</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Sort -->
          <div class="mb-4">
            <label class="form-label fw-bold">Sort By</label>
            <select class="form-select products-filter-trigger-mobile" id="productsSortOrderMobile">
              <option value="featured" {{ request('sort') == 'featured' || !request('sort') ? 'selected' : '' }}>Featured</option>
              <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
              <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
            </select>
          </div>

          <!-- Product Types -->
          <div class="mb-4">
            <h5 class="fw-bold mb-3">Product Types</h5>
            @foreach($productCategories as $category)
              <div class="form-check">
                <input class="form-check-input products-filter-category-item-mobile products-filter-trigger-mobile"
                  type="checkbox"
                  value="{{ $category->name }}"
                  id="productsCatMobile{{ $category->id }}"
                  {{ in_array($category->name, $selectedCategories) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="productsCatMobile{{ $category->id }}">
                  {{ $category->name }}
                </label>
              </div>

              @if($category->subcategories->count())
                <div class="products-subcategory-wrapper">
                  @foreach($category->subcategories as $sub)
                    <div class="form-check">
                      <input class="form-check-input products-filter-category-item-mobile products-filter-trigger-mobile"
                        type="checkbox"
                        value="{{ $sub->name }}"
                        id="productsSubCatMobile{{ $sub->id }}"
                        {{ in_array($sub->name, $selectedCategories) ? 'checked' : '' }}>
                      <label class="form-check-label" for="productsSubCatMobile{{ $sub->id }}">{{ $sub->name }}</label>
                    </div>
                  @endforeach
                </div>
              @endif
            @endforeach
          </div>

          <!-- Year / Age -->
          <div class="mb-3">
            <h5 class="fw-bold mb-3">Year / Age (Y.O.)</h5>
            @foreach($ages as $age)
              <div class="form-check">
                <input class="form-check-input products-filter-age-item-mobile products-filter-trigger-mobile" type="checkbox"
                       value="{{ $age }}" id="productsAgeMobile{{ Str::slug($age) }}"
                       {{ in_array($age, $selectedAges) ? 'checked' : '' }}>
                <label class="form-check-label" for="productsAgeMobile{{ Str::slug($age) }}">{{ $age }}</label>
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn products-btn-custom-orange" id="productsApplyFiltersBtnMobile">Apply Filters</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Desktop filters
  const categoryCheckboxes = document.querySelectorAll('.products-filter-category-item');
  const ageCheckboxes = document.querySelectorAll('.products-filter-age-item');
  const sortDropdown = document.getElementById('productsSortOrder');

  // Mobile filters
  const categoryCheckboxesMobile = document.querySelectorAll('.products-filter-category-item-mobile');
  const ageCheckboxesMobile = document.querySelectorAll('.products-filter-age-item-mobile');
  const sortDropdownMobile = document.getElementById('productsSortOrderMobile');
  const applyFiltersBtn = document.getElementById('productsApplyFiltersBtnMobile');
  const filterBtn = document.getElementById('productsFilterBtnMobile');
  const filterModal = new bootstrap.Modal(document.getElementById('productsFilterModal'));

  function applyFilters() {
    const currentUrl = new URL(window.location.href);

  
    const selectedCats = Array.from(document.querySelectorAll('.products-filter-category-item:checked, .products-filter-category-item-mobile:checked')).map(cb => cb.value);
    if (selectedCats.length > 0) {
      currentUrl.searchParams.set('categories', selectedCats.join(','));
    } else {
      currentUrl.searchParams.delete('categories');
    }

    const selectedAges = Array.from(document.querySelectorAll('.products-filter-age-item:checked, .products-filter-age-item-mobile:checked')).map(cb => cb.value);
    if (selectedAges.length > 0) {
      currentUrl.searchParams.set('age', selectedAges.join(','));
    } else {
      currentUrl.searchParams.delete('age');
    }

    const sortValue = sortDropdown?.value || sortDropdownMobile?.value;
    if (sortValue && sortValue !== 'featured') {
      currentUrl.searchParams.set('sort', sortValue);
    } else {
      currentUrl.searchParams.delete('sort');
    }

    window.location.href = currentUrl.toString();
  }


  if (categoryCheckboxes.length > 0) {
    categoryCheckboxes.forEach(cb => cb.addEventListener('change', applyFilters));
  }
  if (ageCheckboxes.length > 0) {
    ageCheckboxes.forEach(cb => cb.addEventListener('change', applyFilters));
  }
  if (sortDropdown) {
    sortDropdown.addEventListener('change', applyFilters);
  }


  if (filterBtn) {
    filterBtn.addEventListener('click', function() {
      filterModal.show();
    });
  }

  if (applyFiltersBtn) {
    applyFiltersBtn.addEventListener('click', function() {
      applyFilters();
    });
  }

  const collapsibleTitles = document.querySelectorAll('.products-filter-section-title');
  collapsibleTitles.forEach(title => {
    const target = title.getAttribute('data-bs-target');
    const collapseElement = document.querySelector(target);
    
    if (collapseElement) {
      collapseElement.addEventListener('hidden.bs.collapse', function() {
        title.classList.add('collapsed');
      });
      
      collapseElement.addEventListener('shown.bs.collapse', function() {
        title.classList.remove('collapsed');
      });
    }
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const wishlistButtons = document.querySelectorAll('.add-to-wishlist');

    wishlistButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const productId = this.dataset.productId;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const icon = this.querySelector('i');
            const isWishlisted = icon.classList.contains('wishlisted');

            if (isWishlisted) {
                // Ask before removing
                Swal.fire({
                    title: 'Remove from wishlist?',
                    text: "Are you sure you want to remove this product?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, remove it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make DELETE request
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
                                text: data.success || 'Removed from wishlist',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            icon.classList.remove('wishlisted');
                        })
                        .catch(error => {
                            console.error('Error removing from wishlist:', error);
                        });
                    }
                });
            } else {
                // Add to wishlist
                fetch(`/wishlist/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (response.status === 401) {
                        window.location.href = '/login';
                    }
                    return response.json();
                })
                .then(data => {
                    if (data?.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added!',
                            text: data.success,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        icon.classList.add('wishlisted');
                    } else if (data?.error) {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error('Error adding to wishlist:', error);
                });
            }
        });
    });
});
</script>


@endsection