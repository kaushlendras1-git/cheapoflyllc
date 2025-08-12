  <!-- Tab Navigation -->
        <ul class="nav nav-tabs tabs-booked" id="bookingTabs" role="tablist">

            <li class="nav-item active" role="presentation">
                <a class="nav-link" id="feedback-tab" data-bs-toggle="tab" href="#feedback" role="tab"
                    aria-controls="feedback" aria-selected="false">
                    <i class="ri ri-feedback-line" style="font-size: 20px; color: #4169e1;"
                        title="Quality Feedback"></i>
                </a>
            </li>

              <li class="nav-item" role="presentation">
                <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" href="#remarks" role="tab"
                    aria-controls="remarks" aria-selected="false">
                    <i class="ri ri-sticky-note-line" style="font-size: 20px; color: #d2691e;"
                        title="Booking Remarks"></i>

                </a>
            </li>
         
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="screenshots-tab" data-bs-toggle="tab" href="#screenshots" role="tab"
                    aria-controls="screenshots" aria-selected="false">
                    <i class="ri ri-image-line" style="font-size: 20px; color: #ff6347;" title="Screenshots"></i>
                </a>
            </li>
        
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-0 p-0 booked-content" id="bookingTabsContent">

            <!-- Remarks Tab -->
            @include('web.booking.partials.quality_feedbacks')
              <!-- Remarks Tab -->
            @include('web.booking.partials.remarks', ['remarks' => $booking->remarks])

            <!-- Screenshots Tab -->
            @include('web.booking.partials.screenshots', ['screenshot_images' => $screenshot_images])

