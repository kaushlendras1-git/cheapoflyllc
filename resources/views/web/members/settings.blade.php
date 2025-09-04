@extends('web.layouts.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Account Settings</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" aria-current="page">Settings</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
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

    <div class="create-booking-wrapper">
        <div class="booking-form">
            <!-- Profile Information -->
            <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" disabled>
                            </div>
                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Pseudo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pseudo" value="{{ old('pseudo', auth()->user()->pseudo) }}" disabled>
                            </div>
                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" disabled>
                            </div>
                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                            </div>
                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address', auth()->user()->address) }}">
                            </div>
                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" name="profile_picture" accept="image/*" onchange="previewImage(this, 'profile_preview')">
                                <div class="mt-2" id="profile_preview">
                                    @if (auth()->user()->profile_picture)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="img-thumbnail" style="max-height: 50px;">
                                    @else
                                    <small class="text-muted">No profile picture</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>

            <!-- Change Password -->
            <form action="{{ route('settings.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 position-relative mb-5">
                                <label class="form-label">Current Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>
                            <div class="col-md-4 position-relative mb-5">
                                <label class="form-label">New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="col-md-4 position-relative mb-5">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </div>
                </div>
            </form>

            <!-- Document Upload -->
            <form action="{{ route('settings.documents.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Document Management</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 position-relative mb-5">
                                <label class="form-label">PAN Card</label>
                                <input type="file" class="form-control" name="pan_card" accept="image/*,application/pdf" onchange="previewFile(this, 'pan_preview')">
                                <div class="mt-2" id="pan_preview">
                                    @if (auth()->user()->pan_card)
                                    <a href="{{ asset('storage/' . auth()->user()->pan_card) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Current PAN</a>
                                    @else
                                    <small class="text-muted">No PAN card uploaded</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 position-relative mb-5">
                                <label class="form-label">Aadhar Card</label>
                                <input type="file" class="form-control" name="aadhar_card" accept="image/*" onchange="previewImage(this, 'aadhar_preview')">
                                <div class="mt-2" id="aadhar_preview">
                                    @if (auth()->user()->aadhar_card)
                                    <a href="{{ asset('storage/' . auth()->user()->aadhar_card) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Current Aadhar</a>
                                    @else
                                    <small class="text-muted">No Aadhar card uploaded</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Update Documents</button>
                    </div>
                </div>
            </form>

            <!-- Account Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <strong>Department:</strong>
                            <span class="badge bg-primary">{{ auth()->user()->departments }}</span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Role:</strong>
                            <span class="badge bg-success">{{ auth()->user()->role }}</span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Status:</strong>
                            <span class="badge {{ auth()->user()->status == 1 ? 'bg-success' : 'bg-warning' }}">
                                {{ auth()->user()->status == 1 ? '✅ Active' : '❌ Inactive' }}
                            </span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Member Since:</strong>
                            <span>{{ auth()->user()->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Current Shift:</strong>
                            <span>{{ auth()->user()->currentShift?->shift->name ?? 'No Shift Assigned' }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Current Team:</strong>
                            <span>{{ auth()->user()->currentTeam?->team->name ?? 'No Team Assigned' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="img-thumbnail" style="max-height: 50px;">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewFile(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="img-thumbnail" style="max-height: 50px;">';
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<small class="text-success">File selected: ' + file.name + '</small>';
        }
    }
}
</script>
@endsection
