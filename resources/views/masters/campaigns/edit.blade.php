@extends('web.layouts.main')
@section('content')

    <!--  Content Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!--  Page Header -->
        <div class="lob-header d-flex align-items-center justify-content-between">
            <div>
                <h2 class="lob-title ">
                    <span class="iconify" data-icon="mdi:bullhorn-edit-outline"
                        style="vertical-align: middle; font-size: 14px;"></span>
                    Edit Campaign
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
                        <a href="{{ route('campaign.index') }}" class="lob__breadcrumb-link">
                            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:bullhorn-outline"></span>
                            Campaigns
                        </a>
                    </li>
                    <li class="lob__breadcrumb-item active" aria-current="page">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:bullhorn-edit-outline"></span>
                        Edit Campaign
                    </li>
                </ol>
            </nav>
        </div>

        <!--  Main Row -->
        <div class="row">
            <div class="col-12">

                <!--  Flash Messages -->
                @include('web.layouts.flash')

                <!--  Edit Campaign Form -->
                <div class="lob-card p-5">
                    <form method="POST" action="{{ route('campaign.update', $campaign->id) }}"
                        class="filter-form lob-filter mb-4 p-4 rounded-3">
                        @csrf
                        @method('PUT')

                        <div class="row g-4 align-items-end">

                            <!-- Campaign Name -->
                            <div class="col-md-4 position-relative">
                                <div class="floating-group lob-card">
                                    <input type="text" name="name" id="campaignName" class="form-control input-style w-100"
                                        placeholder=" " value="{{ old('name', $campaign->name) }}" required>
                                    <label for="campaignName" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:bullhorn-outline"></span>
                                        Campaign Name <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 position-relative">
                                <div class="floating-group lob-card">
                                    <select name="status" id="campaignStatus" class="form-control input-style w-100"
                                        required>
                                        <option value="1" {{ old('status', $campaign->status) == 1 ? 'selected' : '' }}>✅
                                            Active</option>
                                        <option value="0" {{ old('status', $campaign->status) == 0 ? 'selected' : '' }}>⛔
                                            Inactive</option>
                                    </select>
                                    <label for="campaignStatus" class="form-label">
                                        <span class="iconify me-1" data-icon="mdi:toggle-switch-outline"></span>
                                        Status <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="col-md-4 d-flex  gap-3">
                                <!-- <a href="{{ route('campaign.index') }}"
                                        class="btn btn-light d-flex align-items-center gap-2 button-style px-5 py-3">
                                        <span class="iconify fs-5" data-icon="mdi:arrow-left"></span>
                                        Cancel
                                    </a> -->

                                <button type="submit"
                                    class="btn btn-primary d-flex align-items-center gap-2 button-style px-5 py-3">
                                    <span class="iconify fs-5" data-icon="mdi:content-save-edit-outline"></span>
                                    Update Campaign
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