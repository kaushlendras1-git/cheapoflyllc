<div class="tab-pane fade " id="changes" role="tabpanel" aria-labelledby="changes-tab">
    <div class="lob-card p-4 show-booking-card mt-3 shadow-sm">

        <!-- Header -->
        <div class="lob-header d-flex align-items-center justify-content-between mb-4">
            <h4 class="lob-title mb-0"> Changes</h4>
        </div>

        <!-- Progress Form -->
        <div class="lob-card p-4 border rounded-3 shadow-sm">
            <!-- Amount / Description -->
            <div class="row g-3">
                <div class="col-md-2 mb-4">
                    <div class="floating-group lob-card">
                        <input type="text" id="amount" class="form-control input-style" value="">
                        <label class="form-label">Amount</label>
                    </div>
                </div>
                <div class="col-md-10 mb-4">
                    <div class="floating-group lob-card">
                        <select id="description" name="description" class="form-control input-style">
                            <option value="">-- Select Description --</option>
                            <option value="airline">Airline</option>
                            <option value="cruise">Cruise</option>
                            <option value="hotel">Hotel</option>
                            <option value="car_vendor">Car Vendor</option>
                            <option value="train">Train</option>
                            <option value="agency">Agency</option>
                        </select>
                        <label class="form-label">Description</label>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-2">
                <div class="col-md-8 mb-4">
                    <div class="floating-group lob-card">
                        <textarea id="changes_remarks" name="changes_remarks" class="form-control input-style" rows="3" placeholder=" "></textarea>
                        <label class="form-label">Remarks Section</label>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="floating-group lob-card">
                        <select id="progress_status" name="progress_status" class="form-control input-style">
                            <option value="">-- Select Status --</option>
                            <option value="pending">Pending with Agent</option>
                            <option value="in_progress">Under Follow-Up</option>
                            <option value="completed">Pending with Airlines/Cruises</option>
                            <option value="under_review">Closed</option>
                        </select>
                        <label class="form-label">Progress Status Tracker</label>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="text-end">
                <button type="button" id="submitChangeBtn" class="btn btn-primary button-style d-flex align-items-center gap-2 px-4 py-2">
                    <i class="ri-send-plane-line fs-5"></i> Submit
                </button>
            </div>
        </div>

        <!-- Case Progress History (Matched Layout) -->
        <div class="lob-card mt-4 p-3 border rounded-3 shadow-sm table-container table-2">


            <div class="table-wrapper">
                <div class="table-scroll">
                    <table class="table align-middle table-striped mb-0">
                        <thead class="table-light sticky-header">
                            <tr>
                                <th>S.No</th>
                                <th>Status</th>
                                <th>Amount / Description</th>
                                <th>Remarks</th>
                                <th>Attempted By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No changes recorded yet</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->

    </div>
</div>