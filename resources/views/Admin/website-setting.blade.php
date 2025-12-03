@extends('Admin.layout.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Website Settings</h2>

     @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>There were some errors:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="mb-3 col-md-6">
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="logo" class="form-label mb-0">Website Logo:</label>
                        @if ($settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" class="ms-2 mb-1 border shadow-sm rounded"
                                width="40" height="40" alt="Logo Preview">
                        @endif
                    </div>
                    <input type="file" class="form-control mt-2" name="logo">
                </div>


                {{-- Banner Image --}}
                <div class="mb-3 col-md-6">
                    <label for="banner_image" class="form-label">Banner Image:</label>
                    @if ($settings->banner_image)
                        <img src="{{ asset($settings->banner_image) }}"
                            class="ms-2 mb-1 border shadow-sm rounded" width="40" height="40" alt="Logo Preview">
                    @endif
                    <input type="file" class="form-control" name="banner_image">
                </div>

                {{-- Banner Tagline --}}
                <div class="mb-3 col-md-12">
                    <label for="banner_tagline" class="form-label">Banner Tagline:</label>
                    <input type="text" class="form-control" name="banner_tagline" value="{{ $settings->banner_tagline }}"
                        placeholder="Enter tagline">
                </div>
            </div>

            <hr class="my-4">

            <h4 class="mb-3">About Section</h4>

            <div class="row">
                {{-- About Image --}}
                <div class="mb-3 col-md-6">
                    <label for="about_image" class="form-label">About Image:</label>
                    @if ($settings->about_image)
                        <img src="{{ asset( $settings->about_image) }}"
                            class="ms-2 mb-1 border shadow-sm rounded" width="40" height="40" alt="Logo Preview">
                    @endif
                    <input type="file" class="form-control" name="about_image">

                </div>
{{-- Year of Experience --}}
<div class="mb-3 col-md-6">
    <label for="year_of_exp" class="form-label">Year of Experience:</label>
    <input type="number" class="form-control" name="year_of_exp" 
           value="{{ $settings->year_of_exp ?? '' }}" placeholder="Enter years of experience">
</div>
                {{-- About Heading --}}
                <div class="mb-3 col-md-12">
                    <label for="about_heading" class="form-label">About Heading:</label>
                    <input type="text" class="form-control" name="about_heading" value="{{ $settings->about_heading }}"
                        placeholder="Enter about heading">
                </div>

                {{-- About Description --}}
                <div class="mb-3 col-md-12">
                    <label for="about_description" class="form-label">About Description:</label>
                    <textarea name="about_description" class="form-control" rows="4" placeholder="Enter about section description">{{ $settings->about_description }}</textarea>
                </div>
            </div>
<div class="row g-4">
    {{-- Mission --}}
    <div class="col-md-4">
        <label for="mission_heading" class="form-label">Mission Heading</label>
        <input type="text" class="form-control" name="mission_heading" value="{{ $settings->mission_heading }}">
        <label for="mission_text" class="form-label mt-2">Mission Text</label>
        <textarea class="form-control" name="mission_text" rows="4">{{ $settings->mission_text }}</textarea>
    </div>

    {{-- Vision --}}
    <div class="col-md-4">
        <label for="vision_heading" class="form-label">Vision Heading</label>
        <input type="text" class="form-control" name="vision_heading" value="{{ $settings->vision_heading }}">
        <label for="vision_text" class="form-label mt-2">Vision Text</label>
        <textarea class="form-control" name="vision_text" rows="4">{{ $settings->vision_text }}</textarea>
    </div>

    {{-- Team --}}
    <div class="col-md-4">
        <label for="team_heading" class="form-label">Team Heading</label>
        <input type="text" class="form-control" name="team_heading" value="{{ $settings->team_heading }}">
        <label for="team_text" class="form-label mt-2">Team Text</label>
        <textarea class="form-control" name="team_text" rows="4">{{ $settings->team_text }}</textarea>
    </div>
</div>

            <button type="submit" class="btn mt-2" style="background-color: #97351E; color: white;">Save Settings</button>
        </form>
    </div>
@endsection
