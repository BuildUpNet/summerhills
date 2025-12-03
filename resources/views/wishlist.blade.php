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
                    <span class="text-white-75">Wishlist</span>
                </p>
                
               {{-- Main Heading --}}
                <h1 class="display-3 fw-bold mb-0 text-white" style="font-family: var(--heading-font-family);">
                    My Wishlist 
                </h1>
            </div>
        </div>
    </section>



<section class="ftco-section">
    <div class="container">
        @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

        <div class="row">
            <div class="table-wrap">
                <table class="table">
                    <thead class="thead-primary">
                        <tr>
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Brand_Name</th>
                              <th>Price</th>
                            <th>Year_old</th>
                            <th>Alchole%</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wishlistItems as $item)
                        <tr>
                            <td>
                                <div class="img" style="background-image: url('{{ asset($item->product->image) }}'); width: 100px; height: 100px; background-size: cover;"></div>
                            </td>
                            <td>
                                <div class="email">
                                    <span>{{ $item->product->title }}</span>
                                    <span>{{ Str::limit($item->product->description, 25) }}</span>
                                </div>
                            </td>
                            <td>{{ $item->product->brand_name }}</td>
                             <td> $ {{ $item->product->price }}</td>
                              <td>{{ $item->product->year_old }}</td>
                            <td>{{$item->product->alcohol_percentage }}</td>
                            <td>
                                <form action="{{ route('wishlist.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Your wishlist is empty.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
