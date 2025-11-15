@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <h2 class="lob-title">
            <span class="iconify" data-icon="mdi:store-outline" style="vertical-align: middle; font-size: 14px;"></span>
            Merchants Management
        </h2>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:store-outline"></span>
                    Merchants
                </li>
            </ol>
        </nav>
    </div>

    <!-- Flash Message -->
    <!-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif -->
    <!--  Flash Messages -->
    @include('web.layouts.flash')

    <!-- Table Card -->
    <div class="lob-card">
        <div class="table-container table-2">

            <!-- Table Header -->
            <div class="table-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#merchantModal">
                    <span class="iconify" data-icon="mdi:plus-circle-outline" style="font-size: 1rem;"></span>
                    Add Merchant
                </button>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="serial-col">ID</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($merchants as $merchant)
                        <tr>
                            <td class="serial-col">{{ $merchant->id }}</td>
                            <td>
                                @if($merchant->logo)
                                <img src="{{ asset('storage/' . $merchant->logo) }}" alt="Logo"
                                    style="width: 120px; height: 30px; object-fit: cover; border-radius: 6px;">
                                @else
                                <img src="{{ asset('assets/img/default-logo.png') }}" alt="Logo"
                                    style="width: 120px; height: 30px; object-fit: cover; border-radius: 6px;">
                                @endif
                            </td>
                            <td>{{ $merchant->name }}</td>
                            <td>{{ $merchant->email }}</td>
                            <td>{{ $merchant->phone }}</td>
                            <td>
                                <span class="badge bg-{{ $merchant->status ? 'success' : 'danger' }}">
                                    {{ $merchant->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center table-actions">
                                <button class="btn btn-sm" onclick="editMerchant({{ $merchant }})"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <span class="iconify" data-icon="mdi:pencil-outline"></span>
                                </button>

                                <form method="POST" action="{{ route('merchants.destroy', $merchant->id) }}"
                                    style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm" data-bs-toggle="tooltip" title="Delete"
                                        onclick="return confirm('Delete?')">
                                        <span class="iconify" data-icon="mdi:trash-can-outline"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>

<!-- Merchant Modal -->
<div class="modal fade lob-modal-premium" id="merchantModal" tabindex="-1" aria-labelledby="merchantModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="merchantModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:store-outline"></span>
                    Add Merchant
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body" style="padding: 10px !important;">
                <form id="merchantForm" method="POST" action="{{ route('merchants.store') }}"
                    enctype="multipart/form-data" class="filter-form lob-filter mb-4 p-4 rounded-3">
                    @csrf

                    <div class="row g-4 align-items-end">

                        <!-- Name -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="name" id="merchantName" class="form-control input-style"
                                    placeholder=" " required>
                                <label for="merchantName" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:account-outline"></span>
                                    Name <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Logo -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="file" name="logo" id="merchantLogo" class="form-control input-style"
                                    accept="image/*" placeholder=" ">
                                <label for="merchantLogo" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:image-outline"></span>
                                    Logo
                                </label>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="email" name="email" id="merchantEmail" class="form-control input-style"
                                    placeholder=" " required>
                                <label for="merchantEmail" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:email-outline"></span>
                                    Email <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="phone" id="merchantPhone" class="form-control input-style"
                                    placeholder=" ">
                                <label for="merchantPhone" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:phone-outline"></span>
                                    Phone
                                </label>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <textarea name="address" id="merchantAddress" class="form-control input-style"
                                    placeholder=" "></textarea>
                                <label for="merchantAddress" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:home-outline"></span>
                                    Address
                                </label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 position-relative">
                            <div class="floating-group lob-card">
                                <select name="status" id="merchantStatus" class="form-control input-style"
                                    placeholder=" ">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <label for="merchantStatus" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:toggle-switch-outline"></span>
                                    Status
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 gap-2 " style="display:flex; align-items: center;
    justify-content: end;">
                            <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2"
                                style="background-color: var(--muted); color: #fff !important; border: none!important;"
                                data-bs-dismiss="modal">
                                <span class="iconify fs-5" style="color: #fff !important;"
                                    data-icon="mdi:close-circle-outline"></span>
                                Close
                            </button>

                            <button type="submit" form="merchantForm"
                                class="btn button-style d-flex align-items-center gap-2 px-5 py-3"
                                style="background-color: var(--primary); color: #fff !important;">
                                <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"
                                    style="color: #fff !important;"></span>
                                Save
                            </button>
                        </div>



                    </div>
                </form>

            </div>



        </div>
    </div>
</div>


<script>
function editMerchant(merchant) {
    document.getElementById('merchantForm').action = `/masters/merchants/${merchant.id}`;
    document.getElementById('merchantForm').innerHTML += '<input type="hidden" name="_method" value="PUT">';
    document.querySelector('.modal-title').innerHtml = 'Edit Merchant';
    document.querySelector('[name="name"]').value = merchant.name;
    document.querySelector('[name="email"]').value = merchant.email;
    document.querySelector('[name="phone"]').value = merchant.phone || '';
    document.querySelector('[name="address"]').value = merchant.address || '';
    document.querySelector('[name="status"]').value = merchant.status;
    document.querySelector('[name="logo"]').value = '';
    new bootstrap.Modal(document.getElementById('merchantModal')).show();
}
</script>

@endsection