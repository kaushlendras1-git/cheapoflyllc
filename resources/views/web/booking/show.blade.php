@extends('web.layouts.main')
@section('content')

@php
$roleId = (int) auth()->user()->role_id;
$booking->payment_status_id = (int) $booking->payment_status_id;
$disabled = (($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) ? 'disabled' : '';
$readonly = (($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) ? 'readonly' : '';
@endphp

<style>
.no-border-important {
    border: none !important;
    border-bottom: 1px solid black !important;
}

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

.ck-balloon-panel_visible {
    display: none !important;
}

.ck {
    max-width: 400px;
    margin: 0 auto;
}

.filepond--credits {
    display: none !important;
}
</style>

<span id="flight_uploaded_files" data-baseUrl="{{ asset('') }}" data-images="{{ $booking->flightbookingimage }}"></span>
<span id="hotel_uploaded_files" data-baseUrl="{{ asset('') }}" data-images="{{ $booking->hotelbookingimage }}"></span>
<span id="cruise_uploaded_files" data-baseUrl="{{ asset('') }}" data-images="{{ $booking->cruisebookingimage }}"></span>
<span id="car_uploaded_files" data-baseUrl="{{ asset('') }}" data-images="{{ $booking->carbookingimage }}"></span>
<span id="train_uploaded_files" data-baseUrl="{{ asset('') }}" data-images="{{ $booking->trainbookingimage }}"></span>
<span id="screenshots_uploaded_files" data-baseUrl="{{ asset('') }}" data-images="{{ $booking->screenshot }}"></span>


<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:book-open-page-variant-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Edit Booking
            </h2>
        </div>

        <!--  Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <!-- Dashboard -->
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon me-1" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>

                <!-- Booking -->
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('booking.index') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon me-1"
                            data-icon="mdi:book-open-page-variant-outline"></span>
                        Booking
                    </a>
                </li>

                <!-- Edit Booking -->
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon me-1" data-icon="mdi:pencil-outline"></span>
                    Edit Booking
                </li>
            </ol>
        </nav>

    </div>
    <div class="row gy-4">
        <!-- Booking Table Card -->
        <div class="col-12">
            <div class="lob-card p-4">
                <div class="upper-status d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex fs12">
                        <strong class="book-upper-tags">Booking :</strong><span
                            class="book-bottom-tags">{{ $booking->id }}</span>
                        <strong class="book-upper-tags">Sales:</strong><span
                            class="book-bottom-tags">{{ $booking->user?->name ?? 'N/A' }} </span>

                        <strong class="book-upper-tags">Issued On:</strong><span
                            class="book-bottom-tags">{{ $booking->created_at }}</span>

                        @if($booking->shared_booking)
                        @php
                        $sharedUser = \App\Models\User::find($booking->shared_booking);
                        @endphp
                        <strong class="book-upper-tags"> Divided with:</strong><span
                            class="book-bottom-tags">{{$sharedUser->name ?? ''}} </span>
                        @endif


                        @if (isset($booking->quality_score))
                        <strong class="book-upper-tags">Qc Score :</strong>
                        <span class="book-bottom-tags">{{ $booking->quality_score }}%</span>

                        <strong class="book-upper-tags">Qc Status :</strong>
                        @if ($booking->quality_score < 30) <span style="color: red;">Rejected</span>
                            @else
                            <span style="color: #055bdb;">Approved</span>
                            @endif

                            @endif

                    </div>


                    @if ($booking->pricingDetails && count($booking->pricingDetails) > 0)
                    <div class="d-flex gap-2">
                        @include('web.booking.partials.authModel')

                        <a href="{{ route('auth-history', $hashids) }}"
                            class="btn btn-primary btn-sm rounded-pill auth-button d-flex align-items-center gap-1">
                            <span class="iconify" data-icon="mdi:email-outline" style="font-size: 16px;"></span>
                            Mail History
                        </a>

                    </div>
                    @endif

                </div>

                <form id="bookingForm" action="{{ route('booking.update', $booking->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <!-- Content -->

                    @include('web.layouts.flash')

                    @php
                    $bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
                    $roleId = auth()->user()->role_id;
                    @endphp

                    <input type="hidden" name="last_updated_at" value="{{ $booking->updated_at }}">
                    <input type="hidden" name="booking_id" value="{{ $booking->id ?? '' }}">

                    <!-- Top Bar -->
                    <div class="mt-2 ps-0">
                        <div class="d-flex justify-content-between align-items-center flex-wrap checkbox-servis">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="form-check form-check-inline">
                                    <input name="booking-type[]" class="form-check-input toggle-tab depositCheck"
                                        type="checkbox" id="booking-flight" value="Flight"
                                        {{ in_array('Flight', $bookingTypes) ? 'checked' : '' }}
                                        {{ (($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) ? 'disabled' : '' }}
                                        {{ auth()->user()->department_id == 5 ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="booking-flight">Flight</label>
                                    @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7 &&
                                    in_array('Flight', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Flight">
                                    @endif
                                    @if(auth()->user()->department_id == 5 && in_array('Flight', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Flight">
                                    @endif
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="booking-type[]" class="form-check-input toggle-tab depositCheck"
                                        type="checkbox" id="booking-hotel" value="Hotel"
                                        {{ in_array('Hotel', $bookingTypes) ? 'checked' : '' }}
                                        {{ (($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) ? 'disabled' : '' }}
                                        {{ auth()->user()->department_id == 5 ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="booking-hotel">Hotel</label>
                                    @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7 &&
                                    in_array('Hotel', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Hotel">
                                    @endif
                                    @if(auth()->user()->department_id == 5 && in_array('Hotel', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Hotel">
                                    @endif
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="booking-type[]"
                                        class="form-check-input toggle-tab depositCheck cruiseType" type="checkbox"
                                        id="booking-cruise" value="Cruise"
                                        {{ in_array('Cruise', $bookingTypes) ? 'checked' : '' }}
                                        {{ (($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) ? 'disabled' : '' }}
                                        {{ auth()->user()->department_id == 5 ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="booking-cruise">Cruise</label>
                                    @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7 &&
                                    in_array('Cruise', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Cruise">
                                    @endif
                                    @if(auth()->user()->department_id == 5 && in_array('Cruise', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Cruise">
                                    @endif
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="booking-type[]" class="form-check-input toggle-tab depositCheck"
                                        type="checkbox" id="booking-car" value="Car"
                                        {{ in_array('Car', $bookingTypes) ? 'checked' : '' }}
                                        {{ (($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) ? 'disabled' : '' }}
                                        {{ auth()->user()->department_id == 5 ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="booking-car">Car</label>
                                    @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7 &&
                                    in_array('Car', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Car">
                                    @endif
                                    @if(auth()->user()->department_id == 5 && in_array('Car', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Car">
                                    @endif
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="booking-type[]" class="form-check-input toggle-tab depositCheck"
                                        type="checkbox" id="booking-train" value="Train"
                                        {{ in_array('Train', $bookingTypes) ? 'checked' : '' }}
                                        {{ (($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) ? 'disabled' : '' }}
                                        {{ auth()->user()->department_id == 5 ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="booking-train">Train</label>
                                    @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7 &&
                                    in_array('Train', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Train">
                                    @endif
                                    @if(auth()->user()->department_id == 5 && in_array('Train', $bookingTypes))
                                    <input type="hidden" name="booking-type[]" value="Train">
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" style="padding: 5px; font-size: 12px;"
                                    class="btn btn-sm btn-primary text-center">
                                    <i style="width: 14px; margin-right: 3px; height: 14px;"
                                        class="icon-base ri ri-save-2-fill"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form Card -->
                    <div class="pt-5 ps-0">
                        <div class="row booking-form">
                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">PNR <span class="text-danger">*</span></label>
                                <input type="text" class="form-control readonly-field" name="pnr"
                                    value="{{ $booking->pnr }}" readonly>
                            </div>



                            <div class="col-md-2 position-relative mb-5" id="flight-inputs">
                                <label class="form-label">Airline PNR</label>
                                @php
                                $isPaid = $booking->payment_status_id >= 7;
                                $maskedPnr = strlen($booking->airlinepnr) > 2
                                ? substr($booking->airlinepnr, 0, 2) . 'xxx'
                                : $booking->airlinepnr;
                                @endphp

                                @if($isPaid)
                                @if($roleId === 1 && auth()->user()->department_id == 2 )
                                <!-- Role 1: Masked + readonly + hidden real value -->
                                <input type="text" class="form-control readonly-field" value="{{ $maskedPnr }}"
                                    readonly>
                                <input type="hidden" name="airlinepnr" value="{{ $booking->airlinepnr }}">
                                @else
                                <!-- Other roles: Full PNR + readonly (no mask) -->
                                <input type="text" class="form-control readonly-field"
                                    value="{{ $booking->airlinepnr }}" readonly>
                                <input type="hidden" name="airlinepnr" value="{{ $booking->airlinepnr }}">
                                @endif
                                @else
                                <!-- Not paid: Editable for everyone -->
                                <input type="text"
                                    class="form-control @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="airlinepnr" value="{{ $booking->airlinepnr }}"
                                    @if(auth()->user()->department_id
                                == 5) readonly @endif>
                                @endif
                            </div>

                            <div class="col-md-2 position-relative mb-5" id="amadeus-inputs" style="display: none;">
                                <label class="form-label">Amadeus/Sabre PNR</label>
                                <input type="text"
                                    class="form-control  @if((auth()->user()->role_id == 1 || auth()->user()->role_id == 2 ) && $booking->amadeus_sabre_pnr) readonly-field @endif"
                                    name="amadeus_sabre_pnr" value="{{ $booking->amadeus_sabre_pnr }}">
                            </div>


                            <div class="col-md-2 position-relative mb-5" id="hotel-inputs">
                                <label class="form-label">Hotel Ref</label>
                                <input type="text"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="hotel_ref" value="{{ old('hotel_ref', $booking->hotel_ref ?? '') }}"
                                    @if(($roleId==1 || $roleId==2) && $booking->payment_status_id >= 7) readonly @endif
                                @if(auth()->user()->department_id == 5) readonly @endif>
                            </div>
                            <div class="col-md-2 position-relative mb-5" id="cruise-inputs">
                                <label class="form-label">Cruise Ref</label>
                                <input type="text"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="cruise_ref" value="{{ old('cruise_ref', $booking->cruise_ref ?? '') }}"
                                    @if(($roleId==1 || $roleId==2) && $booking->payment_status_id >= 7) readonly @endif
                                @if(auth()->user()->department_id == 5) readonly @endif>
                            </div>




                            <div class="col-md-2 position-relative mb-5" id="car-inputs">
                                <label class="form-label">Car Ref</label>
                                <input type="text"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="car_ref" value="{{ old('car_ref', $booking->car_ref ?? '') }}" @if(($roleId==1
                                    || $roleId==2) && $booking->payment_status_id >= 7) readonly @endif
                                @if(auth()->user()->department_id == 5) readonly @endif>
                            </div>

                            <div class="col-md-2 position-relative mb-5" id="train-inputs">
                                <label class="form-label">Train Ref</label>
                                <input type="text"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="train_ref" value="{{ old('train_ref', $booking->train_ref ?? '') }}"
                                    @if(($roleId==1 || $roleId==2) && $booking->payment_status_id >= 7) readonly @endif
                                @if(auth()->user()->department_id == 5) readonly @endif>
                            </div>

                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Name of the Caller <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="name" value="{{ old('name', $booking->name ?? '') }}" @if(($roleId==1 ||
                                    $roleId==2) && $booking->payment_status_id >= 7) readonly @endif
                                @if(auth()->user()->department_id == 5) readonly @endif>
                            </div>

                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                                @php
                                $maskedPhone = 'xxx xxx ' . substr($booking->phone, -4);
                                @endphp

                                @if($isPaid)
                                @if($roleId === 1 && auth()->user()->department_id == 2 )
                                <!-- Roles 1 & 2: Masked + readonly + hidden real value -->
                                <input type="text" class="form-control readonly-field" value="{{ $maskedPhone }}"
                                    readonly>
                                <input type="hidden" name="phone" value="{{ $booking->phone }}">
                                @else
                                <!-- Other roles: Full phone + readonly -->
                                <input type="text" class="form-control readonly-field"
                                    value="{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', $booking->phone) }}"
                                    readonly>
                                <input type="hidden" name="phone" value="{{ $booking->phone }}">
                                @endif
                                @else
                                <!-- Not paid: Editable for everyone -->
                                <input type="text"
                                    class="form-control @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="phone" id="phone"
                                    value="{{ old('phone', $booking->phone ? preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', $booking->phone) : '') }}"
                                    @if(auth()->user()->department_id == 5) readonly @endif>
                                @endif
                            </div>

                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Reservation Source</label>
                                <input type="text"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif"
                                    name="reservation_source"
                                    value="{{ old('reservation_source', $booking->reservation_source ?? '') }}"
                                    @if(($roleId==1 || $roleId==2) && $booking->payment_status_id >= 7) readonly @endif
                                @if(auth()->user()->role_id == 1 && $booking->reservation_source) readonly @endif >
                            </div>

                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Campaign <span class="text-danger">*</span></label>
                                <select id="campaign" data-sh="Campaign" name="campaign"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    @if(auth()->user()->department_id == 5) disabled @endif>
                                    @foreach ($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}"
                                        {{ old('campaign', $booking->campaign ?? null) == $campaign->id ? 'selected' : '' }}>
                                        {{ $campaign->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if(auth()->user()->role_id == 1 && $booking->campaign)
                                <input type="hidden" name="campaign" value="{{ $booking->campaign }}">
                                @endif
                                @if(auth()->user()->department_id == 5)
                                <input type="hidden" name="campaign" value="{{ $booking->campaign }}">
                                @endif

                                @error('campaign')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Descriptor</label>
                                <input type="text"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif"
                                    name="descriptor" value="{{ old('descriptor', $booking->descriptor ?? '') }}"
                                    @if(auth()->user()->role_id == 1 && $booking->descriptor) readonly @endif >
                            </div>

                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Brands</label>
                                <select id="selected_company" name="selected_company"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif">
                                    @foreach(\App\Models\Merchant::where('status', 1)->get() as $merchant)
                                    <option value="{{ $merchant->id }}"
                                        {{ old('selected_company', $booking->selected_company ?? '') == $merchant->id ? 'selected' : '' }}>
                                        {{ $merchant->name }}</option>
                                    @endforeach
                                </select>
                                @if(auth()->user()->role_id == 1 && $booking->selected_company)
                                <input type="hidden" name="selected_company" value="{{ $booking->selected_company }}">
                                @endif
                            </div>

                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label"> Divided with</label>
                                <select
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif"
                                    name="shared_booking" {{ (auth()->user()->role_id == 1) ? 'disabled' : '' }}>
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $booking->shared_booking == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @if(auth()->user()->role_id == 1 && $booking->shared_booking)
                                <input type="hidden" name="shared_booking" value="{{ $booking->shared_booking }}">
                                @endif
                            </div>


                            <div class="col-md-2 position-relative mb-5">
                                <label class="form-label">Booking Type</label>
                                <select id="query_type"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif @if(auth()->user()->department_id == 5) readonly-field @endif"
                                    name="query_type" @if(auth()->user()->department_id == 5) disabled @endif>
                                    @foreach ($booking_types as $booking_type)
                                    <option value="{{ $booking_type->id }}" data-type="{{ $booking_type->type }}"
                                        data-id="{{ $booking_type->id }}"
                                        {{ old('query_type', $booking->query_type ?? '') == $booking_type->id ? 'selected' : '' }}>
                                        {{ $booking_type->name }}</option>
                                    @endforeach
                                </select>
                                @if(auth()->user()->department_id == 5)
                                <input type="hidden" name="query_type" value="{{ $booking->query_type }}">
                                @endif
                            </div>


                            <div class="col-md-2 position-relative mb-5" id="changes_assign_to_div">
                                <label class="form-label">Changes Assign To</label>
                                <select id="changes_assign_to"
                                    class="form-control @if(($roleId == 1 || $roleId == 2) && $booking->payment_status_id >= 7) readonly-field @endif"
                                    name="changes_assign_to" {{ (auth()->user()->role_id == 1) ? 'disabled' : '' }}>
                                    <option value="">Select User</option>
                                    @foreach ($changesAssignUsers as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('changes_assign_to', $booking->changes_assign_to ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if(auth()->user()->role_id == 1 && $booking->changes_assign_to)
                                <input type="hidden" name="changes_assign_to" value="{{ $booking->changes_assign_to }}">
                                @endif
                            </div>


                            @include('web.booking.status')


                        </div>
                    </div>
                </form>
            </div>

        </div>


        @if (auth()->user()->department_id == 5)
        @include('web.booking.partials.tabs-billing')
        @elseif(auth()->user()->department_id == 2)
                @include('web.booking.partials.tabs-agent')
        @elseif(auth()->user()->department_id == 1)
        @include('web.booking.partials.tabs-admin')
        @elseif(auth()->user()->department_id == 3)
        @include('web.booking.partials.tabs-quality')
        @else
            @include('web.booking.partials.tabs-agent')
        @endif

        <div class="d-flex justify-content-between gap-2 mt-2">
            <a id="prev-tab-btn" class="btn btn-outline-secondary text-center" style="padding: 5px; font-size: 12px;">
                <i class="icon-base ri ri-arrow-left-line"></i>
            </a>

            <a id="next-tab-btn" class="btn btn-outline-secondary text-center" style="padding: 5px; font-size: 12px;">
                <i class="icon-base ri ri-arrow-right-line"></i>
            </a>
        </div>
    </div>
</div>


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

// Auto-reload when booking/payment status changes
let currentBookingStatus = {
    {
        $booking - > booking_status_id ?? 'null'
    }
};
let currentPaymentStatus = {
    {
        $booking - > payment_status_id ?? 'null'
    }
};

function checkForStatusChanges() {
    fetch(`/api/booking-status/${booking_id}`)
        .then(response => response.json())
        .then(data => {
            if (data.booking_status_id !== currentBookingStatus || data.payment_status_id !==
                currentPaymentStatus) {
                location.reload();
            }
        })
        .catch(error => console.error('Status check failed:', error));
}

// Check every 5 seconds
setInterval(checkForStatusChanges, 11115000);
</script>

<script src="{{ asset('resources/js/booking/changes.js') }}"></script>


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

.readonly-field,
.readonly-field {
    background-color: #e9ecef !important;
    opacity: 1 !important;
    cursor: not-allowed !important;
}

input[readonly] {
    background-color: #e9ecef !important;
    opacity: 1 !important;
    cursor: not-allowed !important;
}
</style>



<!-- Add Bank Details Modal -->
<div class="modal fade lob-modal-premium" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="exampleModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:bank-outline"></span>
                    Add Bank Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                    id="billing-close-modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form action="{{ route('booking.billing-details', ['id' => $booking->id]) }}" id="billing-detail-add">
                    @csrf
                    <div class="row g-4 booking-form">

                        <!-- Email -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:email-outline"></span>
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="email" id="billing-email"
                                placeholder="">
                        </div>

                        <!-- Contact Number -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:phone-outline"></span>
                                Contact No. <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="contact_number"
                                pattern="[0-9\-]{10,17}" maxlength="17" placeholder=""
                                oninput="let digits = this.value.replace(/\D/g, ''); if(digits.length > 15) digits = digits.slice(0,15); let x = digits.match(/(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,5})/); this.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '') + (x[4] ? '-' + x[4] : '');">
                        </div>

                        <!-- Street Address -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:home-outline"></span>
                                Street Address <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="street_address"
                                placeholder="">
                        </div>

                        <!-- Country -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:earth"></span>
                                Country <span class="text-danger">*</span>
                            </label>
                            <select class="form-control input-style w-100" name="country" id="billingCountry">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ $country->country_name == 'United States of America' ? 'selected' : '' }}>
                                    {{ $country->country_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- State -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:map-marker-outline"></span>
                                State <span class="text-danger">*</span>
                            </label>
                            <select class="form-control input-style w-100" name="state" id="billingState">
                                <option value="">Select State</option>
                            </select>
                        </div>

                        <!-- City -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:city-variant-outline"></span>
                                City <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="city"
                                placeholder="">
                        </div>

                        <!-- Zip Code -->
                        <div class="col-md-3 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <span class="iconify me-1" data-icon="mdi:mailbox-outline"></span>
                                Zip Code <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-style w-100" name="zip_code"
                                placeholder="">
                        </div>

                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer justify-content-end border-0 p-4">
                <button type="button" class="btn button-style d-flex align-items-center gap-2 px-5 py-3"
                    id="save-billing-detail" style="background-color: var(--primary); color: #fff !important;">
                    <span class="iconify fs-5" data-icon="mdi:content-save-check-outline"
                        style="color: #fff !important;"></span>
                    Save
                </button>
            </div>

        </div>
    </div>
</div>



<div class="modal fade lob-modal-premium" id="editChangeModal" tabindex="-1" aria-labelledby="editChangeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="editChangeModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:pencil-outline"></span>
                    Edit Change
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Edit Change Form -->
                <form id="editChangeForm">
                    <input type="hidden" id="editChangeId">

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Amount</label>
                        <input type="text" id="editAmount" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Description</label>
                        <select id="editDescription" class="form-select">
                            <option value="">-- Select Description --</option>
                            <option value="airline">Airline</option>
                            <option value="cruise">Cruise</option>
                            <option value="hotel">Hotel</option>
                            <option value="car_vendor">Car Vendor</option>
                            <option value="train">Train</option>
                            <option value="agency">Agency</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Remarks</label>
                        <textarea id="editRemarks" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Progress Status</label>
                        <select id="editProgressStatus" class="form-select">
                            <option value="">-- Select Status --</option>
                            <option value="pending">Pending with Agent</option>
                            <option value="in_progress">Under Follow-Up</option>
                            <option value="completed">Pending with Airlines/Cruises</option>
                            <option value="under_review">Closed</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary px-4 py-3 me-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="updateChangeBtn"
                            class="btn button-style d-flex align-items-center gap-2 px-5 py-3"
                            style="background-color: var(--primary); color: #fff !important;">
                            <span class="iconify fs-5" data-icon="mdi:content-save-outline"
                                style="color: #fff !important;"></span>
                            Update
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<script>
let booking_id = "{{ $booking->id }}";
window.bookingId = "{{ $booking->id }}";

// Load states for USA on page load
document.addEventListener('DOMContentLoaded', async function() {
    const countrySelect = document.getElementById('billingCountry');
    const stateSelect = document.getElementById('billingState');

    if (countrySelect.value) {
        try {
            const response = await axios.get(`/statelist/${countrySelect.value}`);
            let stateOptions = '<option value="">Select State</option>';
            response.data.data.forEach(state => {
                stateOptions += `<option value="${state.id}">${state.name}</option>`;
            });
            stateSelect.innerHTML = stateOptions;
        } catch (e) {
            console.error('Failed to load states');
        }
    }
});
</script>

<style>
.readonly-field {
    background-color: #f2f2f3;
    /* same as Bootstrap's disabled bg */
    color: #aba8b1;
    cursor: not-allowed;
    pointer-events: none;
    /* prevents interaction */
}
</style>

@endsection