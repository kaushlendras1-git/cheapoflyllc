@extends('web.layouts.main')
@section('content')

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">

        <h2 class="lob-title">
            <span class="iconify" data-icon="mdi:ip-outline" style="vertical-align: middle; font-size: 14px;"></span>
            IP Access Management
        </h2>

        <!--  Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:shield-check-outline"></span>
                    IP Access
                </li>
            </ol>
        </nav>

    </div>

    <!--  Alert Warning -->
    <!-- @php $openAll = \App\Models\AllowedIp::where('open_all', 1)->where('status', 1)->exists(); @endphp
    @if($openAll)
    <div class="alert alert-warning d-flex align-items-center m-3">
        <span class="iconify me-2" data-icon="mdi:alert-outline"></span>
        <strong>Warning:</strong> All IP addresses are currently allowed to access the system.
    </div>
    @endif -->

    <!--  Main Row -->
    <div class="row">
        <div class="col-12">
            <!--  Flash Messages -->
            @include('web.layouts.flash')

            <!--  Table Card -->
            <div class="lob-card">

                <!--  Table Container -->
                <div class="table-container table-2">
                    <div class="d-flex align-items-center justify-content-end gap-2 flex-wrap">
                        <form method="POST" action="{{ route('allowed-ips.toggle-open-all') }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="btn  btn-{{ $openAll ? 'alert' : 'primary' }} d-flex align-items-center gap-2">
                                <span class="iconify"
                                    data-icon="{{ $openAll ? 'mdi:lock-off-outline' : 'mdi:lock-open-outline' }}"></span>
                                {{ $openAll ? 'Disable Open All' : 'Enable Open All' }}
                            </button>
                        </form>

                        <button type="button" class="btn btn-primary d-flex align-items-center gap-2"
                            data-bs-toggle="modal" data-bs-target="#ipModal">
                            <span class="iconify" data-icon="mdi:plus-circle-outline" style="font-size: 1rem;"></span>
                            Add IP Address
                        </button>
                    </div>

                    <!--  Table -->
                    <div class="table-responsive mt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th class="serial-col">ID</th>
                                    <th>IP Address</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ips as $ip)
                                <tr>
                                    <td class="serial-col">{{ $ip->id }}</td>
                                    <td>{{ $ip->ip_address }}</td>
                                    <td>{{ $ip->description }}</td>
                                    <td>
                                        <span class="badge bg-{{ $ip->status ? 'success' : 'danger' }}">
                                            {{ $ip->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="text-center table-actions">
                                        <!-- Edit -->
                                        <a href="{{ route('allowed-ips.edit', $ip->id) }}" class="btn btn-sm"
                                            data-bs-toggle="tooltip" title="Edit IP">
                                            <span class="iconify" data-icon="mdi:pencil-outline"></span>
                                        </a>

                                        <!-- Toggle Status -->
                                        <form method="POST" action="{{ route('allowed-ips.toggle-status', $ip->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm btn-{{ $ip->status ? 'secondary' : 'success' }}"
                                                data-bs-toggle="tooltip"
                                                title="{{ $ip->status ? 'Disable' : 'Enable' }}">
                                                <span class="iconify"
                                                    data-icon="{{ $ip->status ? 'mdi:pause-circle-outline' : 'mdi:check-circle-outline' }}"></span>
                                            </button>
                                        </form>

                                        <!-- Delete -->
                                        <form method="POST" action="{{ route('allowed-ips.destroy', $ip->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                title="Delete IP"
                                                onclick="return confirm('Are you sure you want to delete this IP address?')">
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
            <!--  End Table Card -->
        </div>
    </div>
</div>
<!--  End Content Wrapper -->


<!--  IP Modal (Premium Layout) -->
<div class="modal fade lob-modal-premium" id="ipModal" tabindex="-1" aria-labelledby="ipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="ipModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:ip-network-outline"></span>
                    Add IP Address
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form method="POST" action="{{ route('allowed-ips.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">

                        <!-- IP Address -->
                        <div class="col-md-12 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="ip_address" id="ipAddress" class="form-control input-style"
                                    placeholder=" " required>
                                <label for="ipAddress" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:lan-connect"></span>
                                    IP Address <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="description" id="ipDescription"
                                    class="form-control input-style" placeholder=" ">
                                <label for="ipDescription" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:text-subject"></span>
                                    Description (Optional)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer justify-content-end border-0 p-4">
                    <button type="button" class="btn btn-secondary d-flex align-items-center gap-2 px-4 py-2"
                        data-bs-dismiss="modal">
                        <span class="iconify fs-5" data-icon="mdi:close-circle-outline"></span>
                        Close
                    </button>
                    <button type="submit" class="btn button-style d-flex align-items-center gap-2 px-5 py-3"
                        style="background-color: var(--primary); color: #fff !important;">
                        <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"
                            style="color: #fff !important;"></span>
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection