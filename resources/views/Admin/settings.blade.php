@extends('Admin.layout.app')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">
                    <!-- Tabs nav -->
                    <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-semibold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-semibold" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">Change Password</button>
                        </li>
                    </ul>

                    <!-- Tabs content -->
                    <div class="tab-content" id="settingsTabContent">
                        <!-- Profile Tab -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <div class="text-center mb-4">
                                @if ($admin->profile_image)
                                    <img src="{{ asset('profile_images/' . $admin->profile_image) }}" class="rounded-circle border border-3 shadow-sm" width="120" height="120" alt="Profile Image">
                                @else
                                    <img src="https://via.placeholder.com/120" class="rounded-circle border border-3 shadow-sm" alt="Profile Image">
                                @endif
                            </div>

                            @if (session('success_profile'))
                                <div class="alert alert-success rounded-pill">{{ session('success_profile') }}</div>
                            @endif

                            <form action="{{ route('admin.settings.profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 text-start">
                                    <label class="form-label fw-semibold">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control rounded-pill">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3 text-start">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control rounded-pill">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3 text-start">
                                    <label class="form-label fw-semibold">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}" class="form-control rounded-pill">
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-4 text-start">
                                    <label class="form-label fw-semibold">Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control rounded-pill">
                                    @error('profile_image') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <button type="submit" class="btn w-100 fw-bold" style="background-color: #a43f26; color:white; border-radius:50px;">Update Profile</button>
                            </form>
                        </div>

                        <!-- Password Tab -->
                        <div class="tab-pane fade" id="password" role="tabpanel">
                            @if (session('success_password'))
                                <div class="alert alert-success rounded-pill">{{ session('success_password') }}</div>
                            @endif

                            <form action="{{ route('admin.settings.password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Current Password</label>
                                    <input type="password" name="current_password" class="form-control rounded-pill">
                                    @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">New Password</label>
                                    <input type="password" name="password" class="form-control rounded-pill">
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control rounded-pill">
                                </div>

                                <button type="submit" class="btn w-100 fw-bold" style="background-color: #a43f26; color:white; border-radius:50px;">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
