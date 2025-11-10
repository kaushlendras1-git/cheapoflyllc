@extends('web.layouts.main')
@section('content')

  <!--  Content Wrapper -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
      <div>
        <h2 class="lob-title mb-1">
          <span class="iconify" data-icon="mdi:account-edit-outline"
            style="vertical-align: middle; font-size: 1.8rem;"></span>
          Edit Team
        </h2>
      </div>

      <!--  Breadcrumb -->
      <nav aria-label="breadcrumb" class="lob__breadcrumb">
        <ol class="lob__breadcrumb-list mb-0">
          <li class="lob__breadcrumb-item">
            <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
              <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
              Dashboard
            </a>
          </li>
          <li class="lob__breadcrumb-item">
            <a href="{{ route('teams.index') }}" class="lob__breadcrumb-link">
              <span class="iconify lob__breadcrumb-icon" data-icon="mdi:account-group-outline"></span>
              Teams
            </a>
          </li>
          <li class="lob__breadcrumb-item active" aria-current="page">
            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:account-edit-outline"></span>
            Edit Team
          </li>
        </ol>
      </nav>
    </div>

    <!--  Main Row -->
    <div class="row">
      <div class="col-12">

        <!--  Flash Messages -->
        @include('web.layouts.flash')

        <!--  Edit Team Form -->
        <div class="lob-card p-5">
          <form method="POST" action="{{ route('teams.update', $team->id) }}"
            class="filter-form lob-filter mb-4 p-4 rounded-3 ">
            @csrf
            @method('PUT')

            <div class="row g-4 align-items-end">

              <!--  Name Field -->
              <div class="col-md-4 position-relative">
                <label class="form-label fw-semibold text-dark mb-2">
                  <span class="iconify me-1" data-icon="mdi:account-edit-outline"></span>
                  Team Name <span class="text-danger">*</span>
                </label>
                <input type="text" name="name" class="form-control input-style w-100" placeholder="Enter team name"
                  value="{{ old('name', $team->name) }}" required>
                @error('name')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <!--  LOB Field -->
              <div class="col-md-4 position-relative">
                <label class="form-label fw-semibold text-dark mb-2">
                  <span class="iconify me-1" data-icon="mdi:briefcase-outline"></span>
                  LOB (Line of Business) <span class="text-danger">*</span>
                </label>
                <select name="lob_id" class="form-control input-style w-100" required>
                  <option value="">Select LOB</option>
                  @foreach($lobs as $lob)
                    <option value="{{ $lob->id }}" {{ old('lob_id', $team->lob_id) == $lob->id ? 'selected' : '' }}>
                      {{ $lob->name }}
                    </option>
                  @endforeach
                </select>
                @error('lob_id')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <!--  Status Field -->
              <div class="col-md-4 position-relative">
                <label class="form-label fw-semibold text-dark mb-2">
                  <span class="iconify me-1" data-icon="mdi:toggle-switch"></span>
                  Status <span class="text-danger">*</span>
                </label>
                <select name="status" class="form-control input-style w-100" required>
                  <option value="1" {{ old('status', $team->status) == 1 ? 'selected' : '' }}>✅ Active
                  </option>
                  <option value="0" {{ old('status', $team->status) == 0 ? 'selected' : '' }}>⛔ Inactive
                  </option>
                </select>
                @error('status')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <!--  Update Button -->
              <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 button-style px-5 py-3">
                  <span class="iconify fs-5" data-icon="mdi:content-save-edit-outline"></span>
                  Update Team
                </button>
              </div>

            </div>
          </form>
        </div>
        <!--  End Form Card -->

      </div>
    </div>
  </div>
  <!--  End Content Wrapper -->

@endsection