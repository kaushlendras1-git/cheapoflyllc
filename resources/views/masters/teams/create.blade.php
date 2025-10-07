@extends('web.layouts.main')
@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Add Team</h2>
            <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('teams.index') }}">Teams</a>
                <a class="active">Add Team</a>
            </div>
        </div>
        <div class="row">
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
            <form method="POST" class="mt-2" action="{{ route('teams.store') }}">
                @csrf

                <div class="card p-4 mb-4">
                    <div class="row align-items-end justify-content-between w-100 booking-form gen_form g-3">

                        <!-- Name Field -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label mb-1">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control input-style w-100" placeholder="Enter name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- LOB Field -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label mb-1">LOB <span class="text-danger">*</span></label>
                            <select name="lob_id" class="form-control input-style w-100">
                                <option value="">Select LOB</option>
                                @foreach($lobs as $lob)
                                    <option value="{{ $lob->id }}" {{ old('lob_id') == $lob->id ? 'selected' : '' }}>
                                        {{ $lob->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lob_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Field -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label mb-1">Status <span class="text-danger">*</span></label>
                            <select id="status" data-sh="Team" name="status" class="form-control input-style w-100">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button (Right Corner) -->
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