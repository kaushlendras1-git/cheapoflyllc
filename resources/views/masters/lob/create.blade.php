@extends('web.layouts.main')
@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Add Lobs</h2>
            <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('lobs.index') }}">Lobs</a>
                <a aria-current="page">Add Lobs</a>
            </div>
        </div>

        <div class="row">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ isset($lob) ? route('lobs.update', $lob->id) : route('lobs.store') }}">
                @csrf
                @if(isset($lob))
                    @method('PUT')
                @endif

                <div class="card p-4 mb-4">
                    <div class="row align-items-end justify-content-between w-100 booking-form gen_form">

                        <!-- Name Field -->
                        <div class="col-md-3">
                            <div class="position-relative">
                                <label class="form-label mb-1">Name</label>
                                <input type="text" name="name" class="form-control input-style w-100"
                                    placeholder="Enter name" value="{{ old('name', $lob->name ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="col-md-3">
                            <div class="position-relative">
                                <label class="form-label mb-1">Email</label>
                                <input type="email" name="email" class="form-control input-style w-100"
                                    placeholder="Enter email" value="{{ old('email', $lob->email ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="col-md-3">
                            <div class="position-relative">
                                <label class="form-label mb-1">Password</label>
                                <input type="password" name="password" class="form-control input-style w-100"
                                    placeholder="{{ isset($lob) ? 'Leave blank to keep current' : 'Enter password' }}" {{ !isset($lob) ? 'required' : '' }}>
                            </div>
                        </div>

                        <!-- Right Submit Button -->
                        <div class="col-md-auto text-end">
                            <button type="submit"
                                class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style">
                                <i class="ri ri-save-line fs-5"></i> Submit
                            </button>
                        </div>

                    </div>
                </div>
            </form>




        </div>


        <!--/ Content -->
@endsection