
    <div class="tab-pane fade" id="changes" role="tabpanel" aria-labelledby="changes-tab">
            <div class="card p-4 show-booking-card">


<div class="card shadow-sm mt-4">
  <div class="card-header bg-primary text-white">
    <h5 class="mb-0">Case Progress & Remarks</h5>
  </div>
  <div class="card-body">

    <!-- Attempt Counter Table -->

    
    <!-- Progress Status Tracker -->
    <div class="mb-3">
      <label for="progress_status" class="form-label fw-semibold">Progress Status Tracker</label>
      <select id="progress_status" name="progress_status" class="form-select">
        <option value="">-- Select Status --</option>
        <option value="pending">Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="under_review">Under Review</option>
        <option value="completed">Completed</option>
      </select>
    </div>

    <!-- Attempt Details Row -->
    <div class="row g-3 mb-3">
      <div class="col-md-4">
        <label for="attemptCounter" class="form-label fw-semibold">Amount.</label>
        <input type="text" id="attemptCounter" class="form-control" value="1">
      </div>
      <div class="col-md-8">
        <label for="description" class="form-label fw-semibold">Description</label>
        <select id="description" name="description" class="form-select">
          <option value="">-- Select Description --</option>
          <option value="airline">Airline</option>
          <option value="cruise">Cruise</option>
          <option value="hotel">Hotel</option>
          <option value="car_vendor">Car Vendor</option>
          <option value="train">Train</option>
          <option value="agency">Agency</option>
        </select>
      </div>
    </div>

    <!-- Remarks Section -->
    <div class="mb-3">
      <label for="remarks" class="form-label fw-semibold">Remarks Section</label>
      <textarea id="remarks" name="remarks" class="form-control" rows="3" placeholder="Enter remarks or observations..."></textarea>
    </div>

    <!-- Submit Button -->
    <div class="text-end">
      <button type="submit" class="btn btn-primary px-4">
        <i class="ri-send-plane-line"></i> Submit
      </button>
    </div>
  </div>
</div>



<table>
    <tr>
        <td>S.No</td>
        <td>Status </td>
        <td>Amount / Description</td>
        <td>Remarks</td>
        <td>Attempted BY</td>
    </tr>
    <tr>
        <td>S.No</td>
        <td>Status </td>
        <td>Amount / Description</td>
        <td>Remarks</td>
        <td>Attempted BY</td>
    </tr>
    <tr>
        <td>S.No</td>
        <td>Status </td>
        <td>Amount / Description</td>
        <td>Remarks</td>
        <td>Attempted BY</td>
    </tr>
</table>

             



            </div>
    </div>

