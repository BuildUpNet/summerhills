@extends('layout.main')
@section('content')
<style>


/* --- Hero Section Styling --- */
.mod-contact-hero {
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    height: 350px;
    display: flex;
    align-items: center;
}

.mod-contact-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    content: '';
    /*background: #3a4247;*/
    background: var(--dark-color);
    opacity: 0.85;
}

.mod-contact-hero-content {
    position: relative;
    z-index: 10;
    /*color: #fff;*/
    color: var(--light-text-color);
}

.mod-contact-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0;
    /*color: #fff;*/
    color: var(--light-text-color);
    letter-spacing: 2px;
}

.mod-contact-breadcrumbs  {
    font-size: 1.1rem;
    margin-bottom: 20px;
    font-weight: 300;
    /*margin: 0 5px;*/
}

.mod-contact-breadcrumbs a {
    /*color: #78a4ce;*/
    color: var(--light-text-color);
    text-decoration: none;
    transition: color 0.3s;
}

.mod-contact-breadcrumbs a:hover {
    /*color: #24a1db;*/
    color: var(--primary-color);
}

.mod-contact-breadcrumbs .bi {
    margin: 0 5px;
}

/* --- Main Contact Section Styling --- */
.mod-contact-section {
    padding: 6em 0;
    /*background: #f7f7f7;*/
    background: #fcfcfc;
}

.mod-contact-card-wrapper {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
}

/* --- Info Boxes  --- */
.mod-contact-info-row {
    padding: 30px 15px;
    /*background: #f1f1f1;*/
    background: #f5f5f5;
    border-bottom: 1px solid #eee;
}

.mod-contact-info-box {
    text-align: center;
    padding: 15px;
    margin-bottom: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.mod-contact-info-box:hover {
    transform: translateY(-5px);
}

.mod-contact-icon-wrap {
    width: 60px;
    height: 60px;
    line-height: 60px;
    /*background: #24a1db;*/
    background: var(--primary-color);
    border-radius: 50%;
    margin: 0 auto 15px auto;
    color: #fff;
    font-size: 1.5rem;
    /*box-shadow: 0 5px 15px rgba(36, 161, 219, 0.4);*/
    box-shadow: 0 5px 15px rgba(247, 107, 0, 0.4);
}

.mod-contact-info-heading {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark-color);
    /*color: #306ecd;*/
    margin-bottom: 5px;
}

.mod-contact-info-text p {
    margin-bottom: 0;
    color: #666;
    font-size: 0.95rem;
}

.mod-contact-info-text a {
    /*color: #007fc1;*/
    color: var(--primary-color);
    text-decoration: none;
}

.mod-contact-info-text a:hover {
    /*color: #016db6;*/
    color: #d15a00;
}

/* --- Form and Map Layout --- */
.mod-contact-form-map-row {
    display: flex;
    flex-wrap: wrap;
}

.mod-contact-map-col {
    display: flex;
    align-items: stretch;
    min-height: 450px;
}

.mod-contact-map-box {
    width: 100%;
}

.mod-contact-map-box iframe {
    display: block;
    width: 100%;
    height: 100%;
}

.mod-contact-form-wrap {
    background: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.mod-contact-form-heading {
    font-size: 2rem;
    font-weight: 700;
    /*color: #016db6; */
    color: var(--dark-color);
    margin-bottom: 30px;
    /*border-left: 5px solid #24a1db;*/
    border-left: 5px solid var(--primary-color);
    padding-left: 15px;
}

/* --- Form Elements --- */
.mod-form-group {
    margin-bottom: 25px;
}

.mod-form-label {
    font-weight: 600;
    display: block;
    margin-bottom: 8px;
    /*color: #306ecd;*/
    color: var(--dark-color);
    font-size: 0.9rem;
}

.mod-form-control {
    height: 48px;
    background: #f1f1f1;
    color: #000;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #e6e6e6;
    box-shadow: none;
    padding: 10px 15px;
    width: 100%;
    transition: border-color 0.3s, background-color 0.3s, box-shadow 0.3s;
}

.mod-form-control:focus {
    background: #fff;
    /*border-color: #78a4ce;*/
    border-color: var(--primary-color);
    outline: none;
    /*box-shadow: 0 0 0 0.2rem rgba(36, 161, 219, 0.25);*/
    box-shadow: 0 0 0 0.2rem rgba(247, 107, 0, 0.25);
}

textarea.mod-form-control {
    min-height: 150px;
    resize: vertical;
    padding-top: 15px;
}

/* --- Submit Button --- */
.mod-submit-btn {
    /*background: #24a1db;*/
    background: var(--primary-color);
    color: #fff;
    padding: 12px 30px;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.mod-submit-btn:hover {
    /*background: #007fc1;*/
    /*box-shadow: 0 8px 20px rgba(0, 127, 193, 0.4);*/
    
    background: #d15a00;
    box-shadow: 0 8px 20px rgba(210, 90, 0, 0.4);
}


@media (max-width: 991.98px) {
    .mod-contact-hero {
        height: 250px;
    }

    .mod-contact-title {
        font-size: 2.2rem;
    }

    .mod-contact-section {
        padding: 4em 0;
    }

    .mod-contact-info-row {
        padding: 15px;
    }

    .mod-contact-info-box {
        margin-bottom: 30px;
    }

    .mod-contact-map-col {
        min-height: 300px;
        order: -1;
        margin-bottom: 30px;
    }

    .mod-contact-form-heading {
        font-size: 1.5rem;
    }

    .mod-contact-form-wrap {
        padding: 20px !important;
    }
}
</style>

    {{-- Hero Section --}}
    <!--<section class="mod-contact-hero" style="background-image: url('{{ asset('assets/images/bg_2.jpg') }}');">-->
    <!--    <div class="mod-contact-overlay"></div>-->
    <!--    <div class="container mod-contact-hero-content">-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12 text-center">-->
    <!--                <p class="mod-contact-breadcrumbs">-->
    <!--                    <span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span>-->
    <!--                    <span>Contact Us <i class="fa fa-chevron-right"></i></span>-->
    <!--                </p>-->
    <!--                <h1 class="mod-contact-title">Get In Touch</h1>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    
    <!-- <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ $settings && $settings->banner_image ? asset($settings->banner_image) : asset('assets/images/default_banner.jpg') }}');" data-stellar-background-ratio="0.5">-->
    <!--  <div class="overlay"></div>-->
    <!--  <div class="container">-->
    <!--    <div class="row no-gutters slider-text align-items-end justify-content-center">-->
          <!--<div class="col-md-9 ftco-animate mb-5 text-center">-->
    <!--          <div class="col-md-9 ftco-animate mb-5 text-center" data-aos="fade-down" data-aos-duration="1000">-->
    <!--      	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact Us <i class="fa fa-chevron-right"></i></span></p>-->
    <!--        <h2 class="mb-0 bread">Get In Touch</h2>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</section>-->
    
<!--    {{-- 1. Hero/Header Section --}}-->
<!--<section class="hero-wrap hero-wrap-2 d-flex align-items-center justify-content-center py-5" -->
<!--    style="background-image: url('{{ $settings && $settings->banner_image ? asset($settings->banner_image) : asset('assets/images/default_banner.jpg') }}'); min-height: 350px; background-size: cover; background-position: center;">-->
    
<!--    <div class="overlay" style="background-color: rgba(0, 0, 0, 0.75);"></div> -->
<!--    <div class="container py-5 text-center position-relative" style="z-index: 2;">-->
<!--        <div class="col-md-12 text-center text-white" data-aos="fade-up" data-aos-duration="1000">-->
            
<!--            <p class="breadcrumbs mb-3 fw-normal text-white-50 fs-5" style="font-family: var(--font-family);">-->
<!--                <span class="me-2"><a href="/" class="text-decoration-none text-white">Home <i class="fa fa-chevron-right"></i></a></span>/ -->
<!--                <span class="text-white-75">Contact Us</span>-->
<!--            </p>-->
            
<!--            <h1 class="display-3 fw-bold mb-0 text-white" style="font-family: var(--heading-font-family);" data-anim="fade-down">-->
<!--                The Exclusive Collection-->
<!--            </h1>-->
<!--        </div>-->
<!--    </div>-->
<!--</section> -->

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
                    <span class="text-white-75">Contact Us</span>
                </p>
                
                {{-- Main Heading --}}
                <h1 class="display-3 fw-bold mb-0 text-white" style="font-family: var(--heading-font-family);">
                    Get In Touch 
                </h1>
            </div>
        </div>
    </section>

    {{-- Main Contact Section --}}
    <section class="mod-contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="mod-contact-card-wrapper">

                        <div class="row mod-contact-info-row justify-content-center">

                            {{-- Address Box --}}
                            <!--<div class="col-md-4">-->
                                 <div class="col-md-4" data-anim="fade-up">
                                <div class="mod-contact-info-box">
                                    <div class="mod-contact-icon-wrap">
                                        <span class="bi bi-geo-alt-fill"></span>
                                    </div>
                                    <div class="mod-contact-info-text">
                                        <h4 class="mod-contact-info-heading">Address</h4>
                                        <p>2145 Summerfield blvd se , Unit #3, Airdrie, Alberta
T4B1X5, Canada</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Phone Box --}}
                            <!--<div class="col-md-4">-->
                             <div class="col-md-4"  data-anim="fade-up">
                                <div class="mod-contact-info-box">
                                    <div class="mod-contact-icon-wrap">
                                        <span class="bi bi-telephone-fill"></span>
                                    </div>
                                    <div class="mod-contact-info-text">
                                        <h4 class="mod-contact-info-heading">Phone</h4>
                                        <p><a href="tel://587-600-1325">587-600-1325</a></p>
                                    </div>
                                </div>
                            </div>

                            {{-- Email Box --}}
                            <!--<div class="col-md-4">-->
                                 <div class="col-md-4"  data-anim="fade-up">
                                <div class="mod-contact-info-box">
                                    <div class="mod-contact-icon-wrap">
                                        <span class="bi bi-envelope-fill"></span>
                                    </div>
                                    <div class="mod-contact-info-text">
                                        <h4 class="mod-contact-info-heading">Email</h4>
                                        <p><a href="mailto:Summerhillliquor@gmail.com">Summerhillliquor@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row no-gutters mod-contact-form-map-row">

                            <!--<div class="col-md-7">-->
                                 <div class="col-md-7"  data-anim="fade-right">
                                <div class="mod-contact-form-wrap p-md-5 p-4">
                                    <h3 class="mod-contact-form-heading">Send A Message</h3>
                                    <form method="POST" action="{{ route('contact.submit') }}" id="contactForm"
                                        name="contactForm" class="mod-contact-form">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mod-form-group">
                                                    <label class="mod-form-label" for="name">Full Name</label>
                                                    <input type="text" class="mod-form-control" name="name" id="name"
                                                        placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mod-form-group">
                                                    <label class="mod-form-label" for="email">Email Address</label>
                                                    <input type="email" class="mod-form-control" name="email" id="email"
                                                        placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mod-form-group">
                                                    <label class="mod-form-label" for="subject">Subject</label>
                                                    <input type="text" class="mod-form-control" name="subject" id="subject"
                                                        placeholder="Subject">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mod-form-group">
                                                    <label class="mod-form-label" for="message">Message</label>
                                                    <textarea name="message" class="mod-form-control" id="message" cols="30" rows="5"
                                                        placeholder="Your Message..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mod-form-group mb-0">
                                                    <input type="submit" value="Send Message" class="mod-submit-btn">
                                                    <div class="submitting"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!--<div class="col-md-5 order-md-first mod-contact-map-col">-->
                                 <div class="col-md-5 order-md-first mod-contact-map-col"  data-anim="fade-left">
                                <div class="mod-contact-map-box">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2496.050744798672!2d-114.0117971!3d51.273385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53715fa1c35363d7%3A0xd50f679a18b815ec!2sSummerHill%20Liquor%20Store!5e0!3m2!1sen!2sin!4v1762147532580!5m2!1sen!2sin"
                                        width="100%"
                                        height="100%"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy">
                                    </iframe>
                                    
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SweetAlert Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#007fc1'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#007fc1'
            });
        </script>
    @endif
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            
            duration: 1000, 
            once: false,
            mirror: true
        });
    </script>

@endsection
