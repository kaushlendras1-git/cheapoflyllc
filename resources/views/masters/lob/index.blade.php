@extends('web.layouts.main')
@section('content')

    <!--  Content Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!--  Page Header -->
        <div class="lob-header d-flex align-items-center  justify-content-between ">

            <h2 class="lob-title">
                <span class="iconify" data-icon="mdi:table-cog" style="vertical-align: middle; font-size: 14px;"></span>
                Lobs Management
            </h2>


            <!--  New Breadcrumb -->
            <nav aria-label="breadcrumb" class="lob__breadcrumb">
                <ol class="lob__breadcrumb-list mb-0">
                    <li class="lob__breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                            <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="lob__breadcrumb-item active" aria-current="page">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:folder-outline"></span>
                        Lobs
                    </li>
                </ol>
            </nav>


        </div>

        <!--  Main Row -->
        <div class="row">
            <div class="col-12">
                <!--  Flash Messages -->
                @include('web.layouts.flash')

                <!--   Table Card -->
                <div class="lob-card">


                    <!--  Table -->
                    <div class="table-container table-2">
                        <div class="table-header">
                            <a href="{{ route('lobs.create') }}" class="add-btn">
                                <span class="iconify" data-icon="mdi:plus-circle-outline" style="font-size: 1rem;"></span>
                                Add New Entry
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle ">
                                <thead>
                                    <tr>
                                        <th class="serial-col">Serial No.</th>
                                        <th>Name</th>
                                        <th class=" text-center ">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lobs as $key => $lob)
                                        <tr>
                                            <td class="serial-col">{{ $key + 1 }}</td>
                                            <td>{{ $lob->name }}</td>
                                            <td class="text-center table-actions">
                                                <a href="{{ route('lobs.edit', $lob->id) }}" class="btn btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit ">
                                                    <span class="iconify" data-icon="mdi:pencil-outline"></span>
                                                </a>

                                                <form action="{{ route('lobs.destroy', $lob->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete "
                                                        onclick="return confirm('Are you sure you want to delete this call type?')">
                                                        <span class="iconify" data-icon="mdi:trash-can-outline"></span>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--  Pagination -->
                        <div class="pagination-container">
                            <nav>
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><span class="iconify"
                                                data-icon="mdi:chevron-left"
                                                style="font-size:12px; height:12px; width:12px;"></span></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><span class="iconify"
                                                data-icon="mdi:chevron-right"></span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--  End Card -->

            </div>
        </div>
    </div>
    <!--  End Content Wrapper -->




@endsection