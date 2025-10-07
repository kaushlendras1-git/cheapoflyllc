@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
      <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Edit Team</h2>
            <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('teams.index') }}">Teams</a>
                <a class="active">Edit Team</a>
            </div>
        </div>
  <div class="row">

    @include('web.layouts.flash')

    <!-- Edit Form -->
    <form method="POST" class="mt-3" action="{{ route('teams.update', $team->id) }}">
      @csrf
      @method('PUT') 
      
      <!-- Booking Form Card -->
      <div class="card p-4 mb-4">
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <div class="row mb-3 booking-form">
          <div class="col-md-3 position-relative">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}">
            @error('name')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-3 position-relative">
            <label class="form-label">LOB <span class="text-danger">*</span></label>
            <select name="lob_id" class="form-control">
              <option value="">Select LOB</option>
              @foreach($lobs as $lob)
                <option value="{{ $lob->id }}" {{ old('lob_id', $team->lob_id) == $lob->id ? 'selected' : '' }}>{{ $lob->name }}</option>
              @endforeach
            </select>
            @error('lob_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-3 position-relative">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select id="status" name="status" class="form-control">
              <option value="1" {{ old('status', $team->status) == 1 ? 'selected' : '' }}>Active</option>
              <option value="0" {{ old('status', $team->status) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>

        
      </div>
    </form>
    <!-- /Edit Form -->

  </div>
</div>
<!-- /Content -->

@endsection
