@extends('layout.main')

@php
// Get banner tagline from settings
$raw_tagline = $settings->banner_tagline ?? 'Good Drink for Good Moments';
$tagline_clean_text = html_entity_decode($raw_tagline, ENT_QUOTES, 'UTF-8');

$line1_text = '';
$line2_text = '';

$words = explode(' ', $tagline_clean_text);
$word_count = count($words);

// Split tagline into two lines for better display
if ($word_count <= 5) {
    $line1_text = $tagline_clean_text;
    $line2_text = ''; 
} else {
    $separator = ' for ';
    $parts = explode($separator, $tagline_clean_text, 2);

    if (count($parts) === 2) {
        $line1_text = trim($parts[0]) . $separator;
        $line2_text = trim($parts[1]);
    } else {
        $half = ceil($word_count / 2);
        $line1_text = implode(' ', array_slice($words, 0, $half)) . ' '; 
        $line2_text = implode(' ', array_slice($words, $half));
    }
}

// Words to highlight with orange color
$words_to_style = ['Drink', 'Moments', 'Liquor', 'Spirits'];
$words_to_style_json = json_encode($words_to_style);

// Prepare data for JavaScript
$line1_data = htmlspecialchars($line1_text, ENT_QUOTES, 'UTF-8');
$line2_data = htmlspecialchars($line2_text, ENT_QUOTES, 'UTF-8');
@endphp

@section('content')

<!-- ============================================
     HERO SECTION WITH DYNAMIC STYLED TAGLINE
     ============================================ -->
<section
  class="hero-section text-white d-flex align-items-center"
  data-aos="fade-in"
  style="background-image: url('{{ asset($settings->banner_image) }}');"
>
  <div class="container py-5 py-md-0">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0" data-anim="fade-right">
        
        <!-- Dynamic Styled Tagline -->
        <h1 class="mb-4" style="font-size: 4rem; font-weight: 400; line-height: 1.2;">
          <span id="tagline-line1"></span>
          @if(!empty($line2_text))
            <br>
            <span id="tagline-line2"></span>
          @endif
        </h1>

        <p class="h4 mb-4" style="font-weight: 400;">
          New collection of whiskeys, rum & gin.
        </p>
        
        <a href="{{ route('products.show') }}" class="btn btn-custom-orange text-uppercase py-3">
          Shop now
        </a>
      </div>
    </div>
  </div>

  <!-- Hero Stats Box (Desktop Only) -->
  <div class="d-none d-lg-block hero-right-absolute" data-anim="fade-right">
    <div class="d-inline-block p-3" style="background-color: rgba(0, 0, 0, 0.5)">
      <div id="countdown-timer" class="d-flex justify-content-center">
        <div class="text-center mx-3">
          <h2 class="display-4 mb-0 fw-bold">500+</h2>
          <small class="text-uppercase">Premium Spirits Available</small>
        </div>
        <div class="text-center mx-3">
          <h2 class="display-4 mb-0 fw-bold">15+</h2>
          <small class="text-uppercase">Years of Excellence in Service</small>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Inline JavaScript for Dynamic Styling -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get data from PHP
    const line1Text = "{{ $line1_data }}";
    const line2Text = "{{ $line2_data }}";
    const wordsToStyle = {!! $words_to_style_json !!};

    // Function to style specific words
    function styleWords(text, wordsArray) {
      if (!text) return '';
      
      let styledText = text;
      
      wordsArray.forEach(word => {
        const regex = new RegExp(`\\b(${word})\\b`, 'gi');
        styledText = styledText.replace(regex, '<span style="color: var(--primary-color);">$1</span>');
      });
      
      return styledText;
    }

    // Apply styling to tagline lines
    const line1Element = document.getElementById('tagline-line1');
    const line2Element = document.getElementById('tagline-line2');

    if (line1Element) {
      line1Element.innerHTML = styleWords(line1Text, wordsToStyle);
    }

    if (line2Element && line2Text) {
      line2Element.innerHTML = styleWords(line2Text, wordsToStyle);
    }
  });
</script>

<!-- ============================================
     MARQUEE SECTION
     ============================================ -->
<section class="marquee-section py-3" style="background-color: var(--primary-color)">
  <div class="marquee-content-wrap">
    <p class="marquee-text text-white h5 mb-0 text-uppercase">
      * SummerHill Liquor * &nbsp;&nbsp;&nbsp;&nbsp; 
      * SummerHill Liquor * &nbsp;&nbsp;&nbsp;&nbsp;
      * SummerHill Liquor * &nbsp;&nbsp;&nbsp;&nbsp;
      * SummerHill Liquor * &nbsp;&nbsp;&nbsp;&nbsp;
      * SummerHill Liquor * &nbsp;&nbsp;&nbsp;&nbsp;
      * SummerHill Liquor * &nbsp;&nbsp;&nbsp;&nbsp;
    </p>
  </div>
</section>

<!-- ============================================
     BEST SELLERS SECTION
     ============================================ -->
<section class="container my-5 py-3">
  <h2 class="text-center mb-5" data-anim="fade-up">Our Best Sellers</h2>

  <div class="row row-cols-2 row-cols-md-4 g-4">
    @foreach($BestProduct as $product)
      <div class="col" data-anim="fade-up">
        <div class="product-card text-center p-3">
          <div class="product-image-wrap mb-3">
            <img
              src="{{ asset($product->image) }}" 
              class="img-fluid"
              alt="{{ $product->title }}"
              style="max-height: 200px; object-fit: cover"
            />
          </div>
          <p class="fw-bold mb-1">{{ $product->title }}</p>
          <small class="text-muted">{{ $product->brand_name ?? 'Unknown Brand' }}</small>
          <p class="text-danger fw-bold mt-2">${{ number_format($product->price, 2) }}</p>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- ============================================
     HERO SECTION 2 (CTA)
     ============================================ -->
<section
  class="hero-section-2 text-white d-flex align-items-center text-center"
  data-anim="fade-down"
  style="background-image: url('{{ asset('assets/images/her-2.jpg') }}');"
>
  <div class="container py-5 py-md-0 position-relative" style="z-index: 2">
    <div class="row justify-content-center">
      <div class="col-lg-8"  data-anim="fade-down">
        <h2 class="display-3 mb-4" style="font-size: 4rem; font-weight: 400; line-height: 1.2">
          Explore our exclusive collection of fine spirits.
        </h2>
        <a href="{{ route('products.show') }}" class="btn btn-custom-orange btn-lg text-uppercase py-3 px-5">
          View All Products
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     CATEGORY SLIDER SECTION
     ============================================ -->
<!--<section class="container slider-section my-5 py-5">-->
<section class="slider-section my-5 py-5">
    <div class="container">
  <h2 class="section-title text-center" data-aos="zoom-in">
    Shop by Category
  </h2>

  <!-- Swiper Slider -->
  <div class="swiper category-swiper"  data-anim="fade-up">
    <div class="swiper-wrapper">
      
      @foreach ($categories as $category)
        <div class="swiper-slide">
          <div class="category-box" 
              style="background-image: url('{{ $category->image ? asset( $category->image) : asset('assets/images/default-category.jpg') }}')";>
            <div class="box-content text-white">
              <h2 class="display-5 fw-bold mb-3">{{ $category->name }}</h2>
              <p class="lead">
                {{ $category->description ?? 'Explore our premium collection.' }}
              </p>
             <a href="{{ route('products.show') }}?categories={{ urlencode($category->name) }}" class="btn btn-custom-orange">
  Shop {{ $category->name }}
</a>

            </div>
          </div>
        </div>
      @endforeach

    </div>

    <!-- Navigation Arrows (Desktop only) -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Pagination Dots -->
    <div class="swiper-pagination"></div>
  </div>
    </div>
</section>

<!-- ============================================
     FEATURED PRODUCTS GRID
     ============================================ -->
<section class="container my-5 py-3 featured-grid-section">
  <h2 class="text-center mb-5"  data-anim="fade-up">Browse Our Fines Now</h2>

  <div class="row g-4">
    <!-- Large Featured Image -->
    <div class="col-lg-6"  data-anim="fade-left">
      <div
        class="featured-image-container"
        style="background-image: url('{{ asset('assets/images/Tom-Gore.jpeg') }}');"
        title="Ginger Infused Spirit"
      ></div>
    </div>
<!-- Product Grid -->
<div class="col-lg-6">
  <div class="row row-cols-2 g-4">
    @foreach($BannerProduct as $key => $product)
      <div class="col d-flex align-items-stretch"  data-anim="fade-right">
        <div class="product-item-split text-center border rounded p-3 w-100 shadow-sm">
          <img
            src="{{ asset($product->image) }}"
            class="img-fluid mb-2"
            alt="{{ $product->title }}"
         
          />
          <p class="fw-bold mb-1">{{ $product->title }}</p>
          <p class="fw-bold mb-0 text-dark">${{ number_format($product->price, 2) }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>

      </div>
    </div>
  </div>
</section>

<!-- ============================================
     CTA BANNER
     ============================================ -->
<section class="full-width-banner py-5 py-md-5"  data-anim="fade-down">
  <div class="container my-4">
    <div class="row align-items-center justify-content-center g-4">
      <div class="col-lg-12 text-center mb-4 mb-lg-0">
        <h2 class="display-5 fw-bold text-white mb-3" style="line-height: 1.2">
          Contact us for more information
        </h2>
        <div class="d-flex justify-content-center">
          <a href="{{ url('/contact') }}" class="btn btn-outline-light btn-lg mt-3">
            Learn More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     COLLECTION SHOWCASE
     ============================================ -->
  {{-- 2. Modern About Us Section: Split Design with Accent --}}
    <section class="ftco-section pt-5 pb-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                
                {{-- Image Block --}}
                <div class="col-lg-6 mb-4 mb-lg-0"  data-anim="fade-left">
                    <div class="rounded-4 overflow-hidden shadow-lg" style="border-radius: var(--border-radius) !important;">
                        <img src="{{ $settings->about_image ? asset( $settings->about_image) : asset('assets/images/about.jpg') }}" 
                            alt="About Us Image" 
                            class="img-fluid w-100 object-fit-cover" 
                            style="height: 550px; border-radius: var(--border-radius) !important;">
                    </div>
                </div>

                {{-- Text Content Block --}}
                <div class="col-lg-6 wrap-about pl-lg-5"  data-anim="fade-right">
                    <div class="heading-section">
                        {{-- Subheading in primary color --}}
                        <span class="subheading fw-semibold mb-2 d-block" style="color: var(--primary-color);">SINCE 2013</span>
                        
                        {{-- Main Heading --}}
                        <h2 class="mb-4 display-5 fw-bold" style="font-family: var(--heading-font-family); color: var(--dark-color);">
                            {{ $settings->about_heading ?? 'Desire Meets A New Taste' }}
                        </h2>
                        
                        {{-- Description text --}}
                        <p class="lead" style="color: var(--body-text-color);">
                            {{ $settings->about_description ?? 'Default about description goes here.' }}
                        </p>
                        
                        {{-- Call to Action or secondary detail --}}
                        <a href="{{ route('about')}}" class="btn btn-custom-orange mt-3">
                          About Us <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    

@endsection
