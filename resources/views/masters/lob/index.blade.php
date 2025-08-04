@extends('web.layouts.main')
@section('content')


<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Payment Status</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb d-flex align-items-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment Status</li>
            </ol>
        </nav>
    </div>
    <div class="row gy-6">
        <!-- Filter Card -->
        <div class="col-md-12">
            <!-- Display success message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif


            <div class="card p-4">
                <form method="GET" action="{{ route('payment-status.index') }}"
                    class="d-flex align-items-end justify-content-between mb-4">
                    <div class="add-follow-btn">
                        <a href="{{route('lobs.create')}}" type="button"
                                class="btn btn-info px-4 py-3 d-flex align-items-center gap-1 waves-effect waves-light button-style"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add New Entry">
                                <i class="ri ri-add-circle-line fs-5"></i> Add
                            </a>
                    </div>
                </form>
                <!-- Table -->
                <div class="payment-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm payment-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
                            <tr>
                                <th>Serial No.</th> <!-- Serial number column -->
                                 <th>Name</th>
                                <th>Reference (User)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lobs as $key => $lob)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $lob->name }}</td>
                                <td>{{ $lob->user->name ?? 'N/A' }}</td>
                                <td>
                                         <a href="{{ route('lobs.edit', $lob->id) }}"
                                        class="">
                                      <img width="25" src="../../../assets/img/icons/img-icons/edit.png" alt="edit-change">
                                      </a>

                                    <form action="{{ route('lobs.destroy', $lob->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="no-btn p-0 ms-3"
                                            onclick="return confirm('Are you sure you want to delete this call type?')">
                                          <img width="25" src="../../../assets/img/icons/img-icons/delete.png" alt="shift-change">
                                          </button>
                                    </form>

                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <!-- Pagination links -->
                    <div class="mt-3">
                        {{ $lobs->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Content -->






<!-- Custom Styles -->
<style>
.dark-header {
    background-color: #312d4b;
    color: #fff;
    border-radius: 0.5rem;
}

.dark-header .form-control,
.dark-header .form-select {
    background-color: #fff;
    color: #000;
    border: 1px solid #ced4da;
}

.dark-header .form-label {
    color: #fff;
}

.dark-header .form-control::placeholder {
    color: #666;
}

.dark-header .btn-warning {
    color: #000;
}

.table td,
.table th {
    font-size: 0.75rem;
}
</style>
@endsection