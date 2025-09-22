<div class="tab-pane fade" id="ringcentral" role="tabpanel" aria-labelledby="ringcentral-tab">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">RingCentral Integration</h5>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-primary" onclick="ringCentralAction('sms')">
                    📩 Send SMS
                </button>
                <button type="button" class="btn btn-sm btn-success" onclick="ringCentralAction('call')">
                    📞 Make Call
                </button>
                <button type="button" class="btn btn-sm btn-warning" onclick="ringCentralAction('fax')">
                    🖨️ Send Fax
                </button>
                <button type="button" class="btn btn-sm btn-info" onclick="ringCentralAction('call-logs')">
                    📋 Call Logs
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Call Comments</h6>
                    <div class="form-group">
                        <label for="ringcentral-comment">Add Comment for Call:</label>
                        <textarea id="ringcentral-comment" class="form-control" rows="4" placeholder="Enter your comment about this call..."></textarea>
                    </div>
                    <button type="button" class="btn btn-primary mt-2" id="save-ringcentral-comment" data-call-id="">
                        Save Comment
                    </button>
                </div>
                <div class="col-md-6">
                    <h6>RingCentral Response</h6>
                    <div id="ringcentral-response" class="border p-3" style="min-height: 200px; background-color: #f8f9fa;">
                        <em>Response will appear here...</em>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('resources/js/ringcentral/comments.js') }}"></script>

<script>
function ringCentralAction(action) {
    const responseDiv = document.getElementById('ringcentral-response');
    responseDiv.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div> Loading...';
    
    fetch(`/ringcentral/${action}`)
        .then(response => response.json())
        .then(data => {
            responseDiv.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
            
            // If it's call-logs, populate call ID for comments
            if (action === 'call-logs' && data.data && data.data.records && data.data.records.length > 0) {
                const saveBtn = document.getElementById('save-ringcentral-comment');
                saveBtn.setAttribute('data-call-id', data.data.records[0].id);
            }
        })
        .catch(error => {
            responseDiv.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
}
</script>