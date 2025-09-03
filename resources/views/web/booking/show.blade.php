@extends('web.layouts.main')
@section('content')
<style>
    /* Ensure FilePond container doesn't shrink weirdly */
    .filepond--root {
        width: 100% !important;
        max-width: 100%;
        box-sizing: border-box;
    }

    /* Optional: give a min-height if it's collapsing */
    .filepond--drop-label {
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    /* Prevent vertical stacking of drag message */
    .filepond--drop-label label {
        white-space: nowrap;
        text-align: center;
    }

    .filepond--item {
        width: calc(50% - 0.5em);
    }
    .ck-balloon-panel_visible{
        display: none !important;
    }
    .ck {
        max-width: 400px;
        margin: 0 auto;
    }
    .filepond--credits{
        display: none !important;
    }
</style>

<span id="flight_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->flightbookingimage}}"></span>
<span id="hotel_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->hotelbookingimage}}"></span>
<span id="cruise_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->cruisebookingimage}}"></span>
<span id="car_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->carbookingimage}}"></span>
<span id="train_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->trainbookingimage}}"></span>
<span id="screenshots_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->screenshot}}"></span>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Edit Booking</h2>
        <div class="breadcrumb">
            <a href="{{ route('user.dashboard') }}" class="active">Dashboard</a>
            <a href="javascript:void(0);">Edit Booking</a>
        </div>
    </div>
    <div class="row">
        <div class="card p-1 create-booking-wrapper">
            <div class="upper-status d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex fs12">
                    <strong class="book-upper-tags">Booking :</strong><span
                        class="book-bottom-tags">{{$booking->id}}</span>
                    <strong class="book-upper-tags">Sales:</strong><span
                      class="book-bottom-tags">{{ $booking->user?->name ?? 'N/A' }} - {{  auth()->user()->departments  }}</span>

                    <strong class="book-upper-tags">Issued On:</strong><span
                        class="book-bottom-tags">{{$booking->created_at}}</span>

                    <strong class="book-upper-tags">Changes:</strong><span
                        class="book-bottom-tags">Zee</span>
                    <strong class="book-upper-tags">Billing:</strong><span
                        class="book-bottom-tags">Mark</span>
                    <strong class="book-upper-tags">Quality:</strong><span
                        class="book-bottom-tags">Smith</span>

                    <strong class="book-upper-tags">Shared :</strong><span
                        class="book-bottom-tags">Agent</span>

                    <strong class="book-upper-tags">Qc Score :</strong><span
                        class="book-bottom-tags">78%</span>
                    <strong class="book-upper-tags">Qc Status :</strong><span
                        style="color: #055bdb;">Approved</span>
                </div>
                <div class="d-flex gap-2">
                    @include('web.booking.partials.authModel')

                    <a href="{{ route('auth-history', $hashids) }}"
                        class="btn btn-outline-secondary btn-sm rounded-pill auth-button">
                        Mail History
                    </a>
                </div>
            </div>

            <form id="bookingForm" action="{{ route('booking.update', $booking->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- Content -->

                @include('web.layouts.flash')

                @php
                $bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
                @endphp

                <input type="hidden" name="last_updated_at" value="{{ $booking->updated_at }}">


                <input type="hidden" name="booking_id" value="{{ $booking->id ?? '' }}">
                <!-- Top Bar -->
                <div class="mt-2 ps-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap checkbox-servis">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-flight" value="Flight"
                                    {{ in_array('Flight', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-flight">Flight</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-hotel" value="Hotel"
                                    {{ in_array('Hotel', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-hotel">Hotel</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-cruise" value="Cruise"
                                    {{ in_array('Cruise', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-cruise">Cruise</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-car" value="Car" {{ in_array('Car', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-car">Car</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-train" value="Train"
                                    {{ in_array('Train', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-train">Train</label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" style="padding: 5px; font-size: 12px;" class="btn btn-sm btn-primary text-center">
                                <i style="width: 14px; margin-right: 3px; height: 14px;" class="icon-base ri ri-save-2-fill"></i> Save
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Booking Form Card -->
                <div class="pt-5 ps-0">
                    <div class="row booking-form">
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">PNR <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pnr" value="{{ $booking->pnr }}" disabled>
                        </div>
                        <fieldset id="flight-inputs" class="toggle-section col-md-6">
                            <div class="row">
                                <div class="col-md-4 position-relative mb-5">
                                    <label class="form-label">Airline PNR</label>
                                    <input type="text" class="form-control" name="airlinepnr"
                                        value="{{ $booking->airlinepnr }}"
                                        @if($booking->airlinepnr) disabled  @endif
                                    >
                                </div>

                                <div class="col-md-4 position-relative mb-5">
                                    <label class="form-label">Amadeus/Sabre PNR</label>
                                    <input type="text" class="form-control" name="amadeus_sabre_pnr"
                                        value="{{ $booking->amadeus_sabre_pnr }}"
                                         @if($booking->amadeus_sabre_pnr) disabled  @endif
                                         >
                                </div>

                                <div class="col-md-4 position-relative mb-5">
                                    <label class="form-label"> PNR Type</label>
                                    <select class="form-control" name="pnrtype22">
                                        <option value="">Select</option>
                                        <option value="FXL" {{$booking->pnrtype == 'FXL'?'selected':''}}>FXL</option>
                                        <option value="GK" {{$booking->pnrtype == 'GK'?'selected':''}}>GK</option>
                                        <option value="HK" {{$booking->pnrtype == 'HK'?'selected':''}}>HK</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <div class="col-md-2 position-relative mb-5" id="hotel-inputs">
                            <label class="form-label">Hotel Ref</label>
                            <input type="text" class="form-control" name="hotel_ref"
                            value="{{ old('hotel_ref', $booking->hotel_ref ?? '') }}">
                        </div>
                        <div class="col-md-2 position-relative mb-5" id="cruise-inputs">
                            <label class="form-label">Cruise Ref</label>
                            <input type="text" class="form-control" name="cruise_ref"
                            value="{{ old('cruise_ref', $booking->cruise_ref ?? '') }}">
                        </div>




                        <div class="col-md-2 position-relative mb-5" id="car-inputs">
                            <label class="form-label">Car Ref</label>
                            <input type="text" class="form-control" name="car_ref"
                            value="{{ old('car_ref', $booking->car_ref ?? '') }}">
                        </div>
                        <div class="col-md-2 position-relative mb-5" id="train-inputs">
                            <label class="form-label">Train Ref</label>
                            <input type="text" class="form-control" name="train_ref"
                            value="{{ old('train_ref', $booking->train_ref ?? '') }}">
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Name of the Caller <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $booking->name ?? '') }}">
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $booking->phone ?? '') }}">
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Reservation Source</label>
                            <input type="text" class="form-control" name="reservation_source" value="{{ old('reservation_source', $booking->reservation_source ?? '') }}">
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Campaign <span class="text-danger">*</span></label>
                            <select id="campaign" data-sh="Campaign" name="campaign" class="form-control">
                              @foreach($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}"
                                            {{ old('campaign', $booking->campaign ?? null) == $campaign->id ? 'selected' : '' }}>
                                        {{ $campaign->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('campaign')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Descriptor</label>
                            <input type="text" class="form-control" name="descriptor"
                                value="{{ old('descriptor', $booking->descriptor ?? '') }}">
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">LOB</label>
                            <select id="selected_company" name="selected_company" class="form-control">
                                <option value="1" {{ old('selected_company', $booking->selected_company ?? '') === '1' ? 'selected' : '' }}>flydreamz</option>
                                <option value="2" {{ old('selected_company', $booking->selected_company ?? '') === '2' ? 'selected' : '' }}> fareticketsllc</option>
                                <option value="3" {{ old('selected_company', $booking->selected_company ?? '') === '3' ? 'selected' : '' }}> fareticketsus</option>
                                <option value="4" {{ old('selected_company', $booking->selected_company ?? '') === '4' ? 'selected' : '' }}> cruiselineservice</option>
                            </select>
                        </div>



                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label"> Is Shared Booking</label>
                            <select class="form-control" name="shared_booking">
                                <option value="">Select</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $booking->shared_booking == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Booking Type</label>
                            <select id="query_type" class="form-control" name="query_type">
                                @foreach($booking_types as $booking_type)
                                    <option value="{{$booking_type->id}}" data-type="{{$booking_type->type}}" data-id="{{$booking_type->id}}" >{{$booking_type->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        @include('web.booking.status')


                    </div>
                </div>
        </div>

            @if(auth()->user()->departments === 'Billing')
                @include('web.booking.partials.tabs-billing')
            @elseif(auth()->user()->departments === 'Sales')
                @include('web.booking.partials.tabs-agent')
            @elseif(auth()->user()->departments === 'Admin')
                @include('web.booking.partials.tabs-admin')
            @elseif(auth()->user()->departments === 'Quality')
                @include('web.booking.partials.tabs-quality')
            @else
                No Data
            @endif



            




    </div>

      </div>



      <div class="d-flex justify-content-between gap-2 mt-2">
    <a id="prev-tab-btn" class="btn btn-sm btn-danger text-center" style="padding: 5px; font-size: 12px;color:#fff" >Previous</a>
    <a id="next-tab-btn" class="btn btn-sm btn-primary text-center" style="padding: 5px; font-size: 12px;color:#fff">Next</a>
</div>


                 


    </div>
</form>


<!-- Button trigger modal -->


<script>
    function getVisibleTabs() {
        // Select all nav-link elements but only those inside visible li (not display:none)
        return Array.from(document.querySelectorAll('#bookingTabs .nav-item'))
            .filter(li => window.getComputedStyle(li).display !== 'none')
            .map(li => li.querySelector('.nav-link'));
    }

    function goToNextTab() {
        let visibleTabs = getVisibleTabs();
        let activeIndex = visibleTabs.findIndex(tab => tab.classList.contains('active'));

        if (activeIndex !== -1 && activeIndex < visibleTabs.length - 1) {
            let nextTab = visibleTabs[activeIndex + 1];
            let tab = new bootstrap.Tab(nextTab);
            tab.show();
        }
    }

    function goToPrevTab() {
        let visibleTabs = getVisibleTabs();
        let activeIndex = visibleTabs.findIndex(tab => tab.classList.contains('active'));

        if (activeIndex > 0) {
            let prevTab = visibleTabs[activeIndex - 1];
            let tab = new bootstrap.Tab(prevTab);
            tab.show();
        }
    }

    document.getElementById('next-tab-btn').addEventListener('click', goToNextTab);
    document.getElementById('prev-tab-btn').addEventListener('click', goToPrevTab);
</script>


<style>
.booked-content table thead th,
.booked-content table tbody td {
    padding: 5px !important;
}
.booked-content table thead th,
.booked-content table tbody td {
    padding: 5px !important;
}
.feedback-textarea {
    resize: vertical;
    min-height: 60px;
}
</style>

<!-- Modal -->
<div class="modal fade bank-details" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bank Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="billing-close-modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('booking.billing-details',['id'=>$booking->id])}}" id="billing-detail-add">
                    @csrf
                    <div class="row booking-form">
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Conatct No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_number">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="street_address">
                        </div>
                        
                        <div class="col-md-3 position-relative">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select class="form-control" name="country">
                                <option value="">Select country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 position-relative">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="state">
                        </div>
                        
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city">
                        </div>

                        
                        <div class="col-md-3 position-relative">
                            <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="zip_code">
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-primary" id="save-billing-detail">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    let booking_id = "{{$booking->id}}";
</script>
@vite('resources/js/booking/edit.js')
@vite('resources/js/auth/sendAuth.js')
@vite('resources/js/booking/pricing.js')
@vite('resources/js/booking/cruise.js')



@endsection
