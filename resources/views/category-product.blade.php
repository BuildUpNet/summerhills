@extends('layout.main')

@section('content')

<!-- Hero Section -->
<!--<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('assets/images/bg_2.jpg') }}');"-->
<!--         data-stellar-background-ratio="0.5">-->
<!--    <div class="overlay"></div>-->
<!--    <div class="container">-->
<!--        <div class="row no-gutters slider-text align-items-end justify-content-center">-->
<!--            <div class="col-md-9 ftco-animate mb-5 text-center">-->
<!--                <p class="breadcrumbs mb-0">-->
<!--                    <span class="mr-2"><a href="{{ route('home') }}">Home <i class="fa fa-chevron-right"></i></a></span>-->
<!--                    <span>{{ $category->name }} <i class="fa fa-chevron-right"></i></span>-->
<!--                </p>-->
<!--                <h2 class="mb-0 bread">{{ $category->name }}</h2>-->
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
                    <span class="text-white-75">{{ $category->name }} <i class="fa fa-chevron-right"></i></span></span>
                </p>
                
                {{-- Main Heading --}}
                <h1 class="display-3 fw-bold mb-0 text-white" style="font-family: var(--heading-font-family);">
                    {{ $category->name }} 
                </h1>
            </div>
        </div>
    </section>

<!-- Product Grid -->
<section class="ftco-section">
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 d-flex">
                    <div class="product ftco-animate">

                        <!-- Product Image with Overlay -->
                        <div class="img d-flex align-items-center justify-content-center"
                             style="background-image: url('{{ asset($product->image) }}');">
                            <div class="desc">
                                <!-- Header Info -->
                                <div class="overlay-header">
                                    <h2>{{ $product->title }}</h2>
                                    <p class="sub-title">
                                        {{ $product->category->name ?? 'Product Details' }}
                                    </p>
                                </div>

                                <!-- Product Details -->
                                <div class="overlay-body">
                                    <div class="details-grid">
                                        <div class="detail-item">
                                            <span class="fa fa-check-square"></span>
                                            <span class="label">Year:</span>
                                            <span class="value">{{ $product->year_old ?? 'N/A' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="fa fa-check-square"></span>
                                            <span class="label">Alcohol:</span>
                                            <span class="value">{{ $product->alcohol_percentage }}%</span>
                                        </div>
                                    </div>

                                    <!-- Explore Button -->
                                    <div class="explore-button-container">
                                        <a href="{{ route('products.single', $product->id) }}"
                                           class="btn btn-sm btn-dark explore-button">
                                            EXPLORE <span class="fa fa-long-arrow-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Brand Name and Like Icon -->
                        <div class="text text-center d-flex justify-content-center align-items-center gap-2">
                            <h2 class="mb-2">{{ $product->brand_name }}</h2>
                            <form>
                                @csrf
                                <button type="submit"
                                        class="btn btn-link text-decoration-none p-0 m-2 add-to-wishlist"
                                        data-product-id="{{ $product->id }}"
                                        style="color: #e74c3c;">
                                    <i class="flaticon-heart" style="font-size: 22px;"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Wishlist Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.add-to-wishlist').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const productId = button.dataset.productId;

                fetch(`/wishlist/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                .then(res => {
                    if (res.status === 401) {
                        window.location.href = "{{ route('login') }}";
                    } else {
                        return res.json();
                    }
                })
                .then(data => {
                    if (data?.success) {
                        alert(data.success); // Replace with toast/notification as needed
                    }
                })
                .catch(err => console.error(err));
            });
        });
    });
</script>

@endsection
