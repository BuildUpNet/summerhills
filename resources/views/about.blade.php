@extends('layout.main')
@section('content')

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
                    <span class="text-white-75">About Us</span>
                </p>
                
                {{-- Main Heading --}}
                <h1 class="display-3 fw-bold mb-0 text-white" style="font-family: var(--heading-font-family);">
                    Our Story 
                </h1>
            </div>
        </div>
    </section>

    {{-- 2. Modern About Us Section: Split Design with Accent --}}
    <section class="ftco-section pt-5 pb-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                
                {{-- Image Block --}}
                <div class="col-lg-6 mb-4 mb-lg-0" data-anim="fade-left">
                    <div class="rounded-4 overflow-hidden shadow-lg" style="border-radius: var(--border-radius) !important;">
                        <img src="{{ $settings->about_image ? asset( $settings->about_image) : asset('assets/images/about.jpg') }}" 
                            alt="About Us Image" 
                            class="img-fluid w-100 object-fit-cover" 
                            style="height: 590px; border-radius: var(--border-radius) !important;">
                    </div>
                </div>

                {{-- Text Content Block --}}
                <div class="col-lg-6 wrap-about pl-lg-5" data-anim="fade-right" data-aos-duration="1000">
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
                        <a href="{{ route('products.show') }}" class="btn btn-custom-orange mt-3">
                            Explore Our Products <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                        
                        {{-- Years of Experience Counter (Inline block) --}}
                        <div class="d-flex align-items-center mt-4 pt-3 border-top border-light">
                            <i class="fa fa-trophy fa-2x me-3" style="color: var(--primary-color);"></i>
                            <div data-anim="fade-down">
                                <strong class="number display-6 fw-bold me-2" data-number="12" style="color: var(--primary-color);"> {{ $settings->year_of_exp}}</strong>
                                <span class="fw-bold text-uppercase small" style="color: var(--body-text-color);">Years of Business Experience</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    
    {{-- 3. Dedicated Mission/Vision Section (Replaces the generic category list on About page) --}}
    <section class="py-5" style="background-color: var(--light-bg-color);">
        <div class="container">
             <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center" data-anim="fade-up">
                    <span class="subheading fw-semibold" style="color: var(--primary-color);">OUR CORE VALUES</span>
                    <h2 class="display-5 fw-bold mb-3" style="font-family: var(--heading-font-family); color: var(--dark-color);">Driven By Excellence and Taste</h2>
                </div>
            </div>
            


        <div class="row g-4 text-center">
            {{-- Mission --}}
            <div class="col-md-4" data-anim="fade-up">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100" style="border-left: 5px solid var(--primary-color);">
                    <i class="fa fa-bullseye fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h4 class="fw-bold" style="color: var(--dark-color);">{{ $settings->mission_heading }}</h4>
                    <p class="mb-0 small" style="color: var(--body-text-color);">{{ $settings->mission_text }}</p>
                </div>
            </div>

            {{-- Vision --}}
            <div class="col-md-4" data-anim="fade-up">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100" style="border-left: 5px solid var(--primary-color);">
                    <i class="fa fa-lightbulb fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h4 class="fw-bold" style="color: var(--dark-color);">{{ $settings->vision_heading }}</h4>
                    <p class="mb-0 small" style="color: var(--body-text-color);">{{ $settings->vision_text }}</p>
                </div>
            </div>

            {{-- Team --}}
            <div class="col-md-4" data-anim="fade-up">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100" style="border-left: 5px solid var(--primary-color);">
                    <i class="fa fa-users fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h4 class="fw-bold" style="color: var(--dark-color);">{{ $settings->team_heading }}</h4>
                    <p class="mb-0 small" style="color: var(--body-text-color);">{{ $settings->team_text }}</p>
                </div>
            </div>
        </div>
    </div>


            </div>
        </div>
    </section>

    {{-- 4. Testimonials Section: High Contrast Background --}}
    <!--<section class="ftco-section testimony-section py-5" -->
    <!--    style="background-image: url('{{ asset('assets/images/bg_4.jpg') }}'); background-attachment: fixed; background-size: cover;">-->
        
    <!--    <div class="overlay" style="background-color: rgba(30, 30, 30, 0.85);"></div> {{-- Dark overlay --}}-->
    <!--    <div class="container position-relative">-->
    <!--        <div class="row justify-content-center mb-5">-->
    <!--            <div class="col-md-7 text-center text-white" data-aos="fade-down">-->
    <!--                <span class="subheading fw-semibold" style="color: var(--primary-color);">CUSTOMER REVIEWS</span>-->
    <!--                <h2 class="display-5 fw-bold mb-3" style="font-family: var(--heading-font-family);">What Our Clients Say</h2>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row" data-aos="fade-up" data-aos-delay="200">-->
    <!--            <div class="col-md-12">-->
    <!--                {{-- Note: You MUST ensure your owl-carousel initialization scripts are correctly loaded for this to work --}}-->
    <!--                <div class="carousel-testimony owl-carousel ftco-owl">-->
    <!--                    @for ($i = 1; $i <= 3; $i++) -->
    <!--                    <div class="item">-->
    <!--                        <div class="testimony-wrap p-4 p-lg-5 bg-white rounded-4 shadow-lg" style="border-radius: var(--border-radius) !important;">-->
    <!--                            <i class="fa fa-quote-left fa-2x mb-3" style="color: var(--primary-color);"></i>-->
    <!--                            <p class="mb-4 fst-italic" style="color: var(--body-text-color);">"Eska consistently delivers on quality and service. Their selection is unparalleled, and the staff is always helpful and knowledgeable. Highly recommended!"</p>-->
    <!--                            <div class="d-flex align-items-center">-->
    <!--                                <img src="{{ asset('assets/images/person_' . $i . '.jpg') }}" -->
    <!--                                     alt="Client Avatar"-->
    <!--                                     class="rounded-circle me-3 object-fit-cover border border-2" -->
    <!--                                     style="width: 60px; height: 60px; border-color: var(--primary-color) !important;">-->
    <!--                                <div>-->
    <!--                                    <p class="name mb-0 fw-bold" style="color: var(--dark-color);">Roger Scott</p>-->
    <!--                                    <span class="position small" style="color: var(--primary-color);">Satisfied Customer</span>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    @endfor-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->


   <section class="py-5 bg-white" data-anim="fade-right">
    <div class="container">
        <div class="row g-4 justify-content-center">
            
        @foreach([
            ['num' => $totalUsers, 'label' => 'Happy Customers', 'delay' => 100, 'icon' => 'fa-users'],
            ['num' => $settings->year_of_exp ?? 0, 'label' => 'Years of Experience', 'delay' => 200, 'icon' => 'fa-clock'],
            ['num' => $totalProducts, 'label' => 'Kinds of Liquore', 'delay' => 300, 'icon' => 'fa-box'],
        ] as $counter)

        <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ $counter['delay'] }}">
            <div class="text-center p-3 p-md-4 rounded-3 border h-100 shadow-sm">
                <i class="fa {{ $counter['icon'] }} fa-3x mb-3" style="color: var(--primary-color);"></i>
                <strong class="number display-5 fw-bold d-block mb-1" data-number="{{ $counter['num'] }}" style="color: var(--dark-color);">0</strong>
                <span class="text-uppercase small fw-bold" style="color: var(--body-text-color);">{{ $counter['label'] }}</span>
            </div>
        </div>

        @endforeach

        </div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const counters = document.querySelectorAll('.number');
    const speed = 800; // 🔹 higher = slower (try 800–1500 for smooth effect)

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-number');
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 10);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });
});
</script>


@endsection