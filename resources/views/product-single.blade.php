@extends('layout.main')

@section('content')


<!-- <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ $settings && $settings->banner_image ? asset($settings->banner_image) : asset('assets/images/default_banner.jpg') }}');" data-stellar-background-ratio="0.5">-->
<!--    <div class="overlay"></div>-->
<!--    <div class="container">-->
<!--        <div class="row no-gutters slider-text align-items-end justify-content-center">-->
<!--            <div class="col-md-9 ftco-animate mb-5 text-center">-->
<!--                <p class="breadcrumbs mb-0">-->
<!--                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="fa fa-chevron-right"></i></a></span>-->
<!--                    <span><a href="{{ url('/products') }}">Products <i class="fa fa-chevron-right"></i></a></span>-->
<!--                    <span>{{ $product->title }} <i class="fa fa-chevron-right"></i></span>-->
<!--                </p>-->
<!--                <h2 class="mb-0 bread">{{ $product->title }}</h2>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

{{-- Product Hero Section - Dynamic like About Page --}}
<section class="hero-wrap hero-wrap-2 d-flex align-items-center justify-content-center py-5" 
    style="background-image: url('{{ $settings && $settings->banner_image ? asset($settings->banner_image) : asset('assets/images/default_banner.jpg') }}'); min-height: 350px; background-size: cover; background-position: center;">
    
    {{-- Darker overlay for better readability --}}
    <div class="hero-overlay-2"></div> 
    
    <div class="container py-5 text-center position-relative" style="z-index: 2;">
        <div class="col-md-12 text-center text-white" data-aos="fade-up" data-aos-duration="1000">
            
            {{-- Breadcrumbs in light text --}}
            <p class="breadcrumbs mb-3 fw-normal text-white-50 fs-5">
                <span class="me-2">
                    <a href="{{ url('/') }}" class="text-decoration-none text-white">
                        Home <i class="fa fa-chevron-right"></i>
                    </a>
                </span> / 
                <span class="me-2">
                    <a href="{{ url('/products') }}" class="text-decoration-none text-white">
                        Products <i class="fa fa-chevron-right"></i>
                    </a>
                </span> / 
                <span class="text-white-75">{{ $product->title }}</span>
            </p>
            
            {{-- Main Product Title --}}
            <h1 class="display-3 fw-bold mb-0 text-white" data-anim="fade-down" style="font-family: var(--heading-font-family);">
                {{ $product->title }}
            </h1>
        </div>
    </div>
</section>


<section class="ftco-section">
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-5 ftco-animate" data-anim="fade-left">
                <a href="{{ asset($product->image) }}" class="image-popup prod-img-bg d-block ">
                    <img src="{{ asset($product->image) }}" class="img-fluid product-image" alt="{{ $product->short_description ?? $product->title }}" loading="lazy">
                </a>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6 product-details pl-md-5 ftco-animate " data-anim="fade-right">
                <h3>{{ $product->title }}</h3>

                <div class="rating d-flex mb-3">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2">5.0</a>
                        @for($i = 0; $i < 5; $i++)
                            <a href="#"><span class="fa fa-star"></span></a>
                        @endfor
                    </p>
                </div>

                <p class="price"><strong>Brand:</strong> {{ $product->brand_name }}</p>
                <p><strong>Short Description:</strong> {{ $product->short_description }}</p>
                <p><strong>Description:</strong> {!! nl2br(e($product->description)) !!}</p>

                <div class="col-md-6 px-0 mt-3">
                    <p style="color: #000;"><strong>Age:</strong> {{ $product->year_old }} Year</p>
                    <p style="color: #000;"><strong>Alcohol:</strong> {{ $product->alcohol_percentage }}%</p>
                </div>

                <!--<p class="mt-4">-->
                <!--    @auth-->
                <!--        @if(Auth::user()->role === 'user')-->
                <!--            <a href="#" class="btn btn-primary py-3 px-5" data-toggle="modal" data-target="#reviewModal">Add Review</a>-->
                <!--        @else-->
                <!--            <a href="{{ route('login') }}" class="btn btn-primary py-3 px-5">Add Review</a>-->
                <!--        @endif-->
                <!--    @else-->
                <!--        <a href="{{ route('login') }}" class="btn btn-primary py-3 px-5">Add Review</a>-->
                <!--    @endauth-->
                <!--</p>-->
                <p class="mt-4 d-flex">
                    @auth
                     @if(Auth::user()->role === 'user')
                            <a href="#" class="btn btn-primary py-2 px-3" data-toggle="modal" data-target="#reviewModal">Add Review</a>
              
                            <a href="#" class="btn py-2 px-3 ms-3 btn-outline-custom-primary"> 
                                <i class="bi bi-heart me-1"></i> Add to Wishlist
                            </a>
                    @else
                            <a href="{{ route('login') }}" class="btn btn-primary py-2 px-3">Add Review</a>
              
                            <a href="{{ route('login') }}" class="btn py-2 px-3 ms-3 btn-outline-custom-primary">
                                <i class="bi bi-heart me-1"></i> Add to Wishlist
                             </a>
                    @endif
                     @else
                        <a href="{{ route('login') }}" class="btn btn-primary py-2 px-3">Add Review</a>
            
                        <a href="{{ route('login') }}" class="btn py-2 px-3 ms-3 btn-outline-custom-primary">
              <i class="bi bi-heart me-1"></i> Add to Wishlist
            </a>
          @endauth
        </p>
            </div>
        </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row mt-5" data-anim="fade-up">
    <div class="col-md-12 nav-link-wrap">
        <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link ftco-animate active mr-lg-1" data-toggle="pill" href="#v-pills-1" role="tab" aria-selected="true">Description</a>
            <a class="nav-link ftco-animate mr-lg-1" data-toggle="pill" href="#v-pills-2" role="tab" aria-selected="false">Manufacturer</a>
            <a class="nav-link ftco-animate" data-toggle="pill" href="#v-pills-3" role="tab" aria-selected="false">Reviews</a>
        </div>
    </div>
</div>


<div class="col-md-12 tab-wrap" >
    <div class="tab-content bg-light" id="v-pills-tabContent" data-anim="fade-up">
        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel">
            <div class="p-4">
                <h3 class="mb-4">{{ $product->title }}</h3>
                <p>{{ $product->description }}</p>
            </div>
        </div>

        <div class="tab-pane fade" id="v-pills-2" role="tabpanel">
            <div class="p-4">
                <h3 class="mb-4">Manufactured By {{ $product->brand_name ?? 'N/A' }}</h3>
                <p>This product is manufactured by {{ $product->brand_name ?? 'N/A' }}.</p>
            </div>
        </div>

       <div class="tab-pane fade" id="v-pills-3" role="tabpanel">
    <div class="p-4 clearfix">
        <h3 class="mb-4">Customer Reviews</h3>

        @if($reviews->count())
            @foreach($reviews as $review)
                <div class="review d-flex mb-4 p-3 border rounded shadow-sm bg-white">
                    <!-- User image -->
                    <div class="review-image mr-3 flex-shrink-0">
                        <!-- Font Awesome default user icon -->
                        <i class="fa fa-user" style="font-size: 60px; color: #aaa;"></i>
                    </div>

                    <!-- Review content -->
                    <div class="review-content flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong>{{ $review->name }}</strong>
                            <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                        </div>
                        <div class="rating mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 18px;"></span>
                            @endfor
                        </div>
                        <p>{{ $review->comment }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p>No reviews yet!</p>
        @endif
    </div>
</div>

     
    </div>
</div>
</section>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <form action="{{ route('reviews.store') }}" method="POST" class="modal-content shadow-sm rounded">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">

      <!-- Header -->
      <div class="modal-header bg-primary text-white py-2">
        <h5 class="modal-title" id="reviewModalLabel">Add Your Review</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                <!-- Star Rating Field -->
                <div class="form-group mb-3">
                    <label for="rating" class="font-weight-bold">Rating</label>
                    <div class="star-rating d-flex flex-row-reverse">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                            <label for="star{{ $i }}" title="{{ $i }} star">
                                <i class="fa fa-star"></i>
                            </label>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="comment">Comment</label>
                <textarea name="comment" class="form-control form-control-sm" rows="3" required></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer py-2">
        <button type="submit" class="btn  btn-sm px-4">Submit</button>
      </div>
    </form>
  </div>
</div>

    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

@endsection
