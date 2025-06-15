@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">

    <h4>Edit Team</h4>

    @include('web.layouts.flash')

    <!-- Edit Form -->
    <form method="POST" action="{{ route('teams.update', $team->id) }}">
      @csrf
      @method('PUT') <!-- This tells Laravel we're updating an existing resource -->

      <!-- Booking Form Card -->
      <div class="card p-4 mb-4">
        <div class="row mb-3">
          <div class="col-md-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}">
            @error('name')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-3">
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

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
    <!-- /Edit Form -->

  </div>
</div>
<!-- /Content -->

@endsection
