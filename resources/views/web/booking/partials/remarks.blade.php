<div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                <div class="card p-4 show-booking-card">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Booking Remarks</h5>
                        <button id="saveRemark" type="button" class="btn btn-primary save-feedback-btn">Save Remark</button>
                    </div>
                    <div class="card-body p-0">
                        <textarea class="form-control" name="particulars" rows="4"
                            placeholder="Enter remarks here..."></textarea>
                    </div>
                    <div class="mt-5">
                        <h5 class="mb-0">Saved booking remarks</h5>
                        <div class="crm-table">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr style="background-color:#e0ecff !important">
                                        <td>Sno.</td>
                                        <td>Remark</td>
                                        <td>Agent</td>
                                        <td>Date/Time</td>
                                        <td>Show/Hide</td>
                                    </tr>
                                </thead>
                                <tbody id="bookingtableremarktable">
                                    @if($remarks)
                                        @foreach($remarks as $key=>$remark)
                                        <tr id="remark-row-{{ $remark->id }}">
                                            <td>{{$key+1}}</td>
                                            <td style="max-width:800px; white-space:normal !important; word-break:break-word; overflow-wrap:break-word;"> {!! $remark->particulars !!}</td>
                                            <td>{{$remark->agentUser?->name}}</td>
                                            <td>{{$remark->created_at}}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox"
                                                        class="form-check-input toggle-remark"
                                                        data-remarkid="{{ $remark->id }}"
                                                        checked>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>