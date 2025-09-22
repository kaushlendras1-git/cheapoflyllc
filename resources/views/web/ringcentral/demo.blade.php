@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">RingCentral Demo & Test Examples</h5>
                    <p class="text-muted">Complete testing guide with sample data</p>
                </div>
                <div class="card-body">
                    <!-- User Info -->
                    <div class="alert alert-info">
                        <strong>Current User:</strong> {{ auth()->user()->name }}<br>
                        <strong>Extension:</strong> {{ auth()->user()->extension ?? 'Not Set' }}<br>
                        <strong>Department:</strong> {{ auth()->user()->departmentRelation->name ?? 'N/A' }}
                    </div>

                    <div class="row">
                        <!-- Test Functions -->
                        <div class="col-md-4">
                            <h6>1. Extension Management</h6>
                            <div class="d-grid gap-2 mb-4">
                                <button class="btn btn-outline-primary" onclick="getAllExtensions()">Get All Extensions</button>
                                <button class="btn btn-outline-info" onclick="getUserByExtension()">Find User by Extension</button>
                            </div>

                            <h6>2. Call Functions</h6>
                            <div class="d-grid gap-2 mb-4">
                                <button class="btn btn-outline-success" onclick="getIncomingCalls()">My Incoming Calls</button>
                                <button class="btn btn-outline-warning" onclick="getCallLogs()">My Call Logs</button>
                                <button class="btn btn-outline-danger" onclick="testWebhook()">Test Webhook</button>
                            </div>

                            <h6>3. Communication</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-secondary" onclick="testSMS()">Send Test SMS</button>
                                <button class="btn btn-outline-dark" onclick="testCall()">Make Test Call</button>
                            </div>
                        </div>

                        <!-- Sample Data -->
                        <div class="col-md-4">
                            <h6>Sample Test Data</h6>
                            <div class="card bg-light">
                                <div class="card-body p-3">
                                    <small>
                                        <strong>Test Extensions:</strong><br>
                                        • 1001 - Sales Agent<br>
                                        • 1002 - Support Agent<br>
                                        • 1003 - Manager<br><br>
                                        
                                        <strong>Test Phone Numbers:</strong><br>
                                        • +1234567890<br>
                                        • +9876543210<br><br>
                                        
                                        <strong>Sample Call ID:</strong><br>
                                        • call-session-12345<br><br>
                                        
                                        <strong>Test Comment:</strong><br>
                                        • "Customer inquiry about billing"
                                    </small>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6>Quick Actions</h6>
                                <div class="d-grid gap-1">
                                    <button class="btn btn-sm btn-success" onclick="addTestComment()">Add Test Comment</button>
                                    <button class="btn btn-sm btn-info" onclick="simulateIncomingCall()">Simulate Incoming Call</button>
                                </div>
                            </div>
                        </div>

                        <!-- Response Area -->
                        <div class="col-md-4">
                            <h6>API Response</h6>
                            <div id="response" class="border p-3" style="height: 400px; overflow-y: auto; background-color: #f8f9fa; font-family: monospace; font-size: 12px;">
                                <em>Click any button to see API response...</em>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-outline-secondary" onclick="clearResponse()">Clear</button>
                                <button class="btn btn-sm btn-outline-primary" onclick="copyResponse()">Copy</button>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Testing Instructions</h6>
                                </div>
                                <div class="card-body">
                                    <ol>
                                        <li><strong>Setup:</strong> First configure RingCentral credentials in Settings</li>
                                        <li><strong>Extensions:</strong> Assign extensions to users via Users management</li>
                                        <li><strong>Test Order:</strong>
                                            <ul>
                                                <li>Start with "Get All Extensions" to see available extensions</li>
                                                <li>Test "Find User by Extension" with extension 1001</li>
                                                <li>Try "My Incoming Calls" to see your call history</li>
                                                <li>Use "Test Webhook" to simulate incoming call</li>
                                            </ul>
                                        </li>
                                        <li><strong>Troubleshooting:</strong> Check browser console for detailed error messages</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Extension Management
function getAllExtensions() {
    showLoading();
    fetch('{{ route("ringcentral.all-extensions") }}')
        .then(response => response.json())
        .then(data => showResponse(data))
        .catch(error => showError(error));
}

function getUserByExtension() {
    showLoading();
    const extension = prompt('Enter extension number (e.g., 1001):', '1001');
    if (extension) {
        fetch(`{{ url('/ringcentral/user-by-extension') }}/${extension}`)
            .then(response => response.json())
            .then(data => showResponse(data))
            .catch(error => showError(error));
    }
}

// Call Functions
function getIncomingCalls() {
    showLoading();
    fetch('{{ route("ringcentral.incoming-calls") }}')
        .then(response => response.json())
        .then(data => showResponse(data))
        .catch(error => showError(error));
}

function getCallLogs() {
    showLoading();
    fetch('{{ route("ringcentral.call-logs") }}')
        .then(response => response.json())
        .then(data => showResponse(data))
        .catch(error => showError(error));
}

function testWebhook() {
    showLoading();
    const webhookData = {
        body: {
            to: { extensionNumber: "{{ auth()->user()->extension ?? '1001' }}" },
            from: { phoneNumber: "+1234567890" },
            direction: "Inbound",
            sessionId: "test-call-" + Date.now()
        }
    };
    
    fetch('{{ route("ringcentral.webhook.incoming-call") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(webhookData)
    })
    .then(response => response.json())
    .then(data => showResponse(data))
    .catch(error => showError(error));
}

// Communication
function testSMS() {
    showLoading();
    fetch('{{ route("ringcentral.sms") }}')
        .then(response => response.json())
        .then(data => showResponse(data))
        .catch(error => showError(error));
}

function testCall() {
    showLoading();
    fetch('{{ route("ringcentral.call") }}')
        .then(response => response.json())
        .then(data => showResponse(data))
        .catch(error => showError(error));
}

// Quick Actions
function addTestComment() {
    showLoading();
    fetch('{{ route("ringcentral.add-comment") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            call_id: 'test-call-12345',
            comment: 'Test comment added via demo page'
        })
    })
    .then(response => response.json())
    .then(data => showResponse(data))
    .catch(error => showError(error));
}

function simulateIncomingCall() {
    showLoading();
    const callData = {
        extension: "{{ auth()->user()->extension ?? '1001' }}",
        caller: "+1234567890",
        timestamp: new Date().toISOString(),
        status: "Incoming"
    };
    
    showResponse({
        status: 'success',
        message: 'Simulated incoming call',
        data: callData
    });
}

// Utility Functions
function showLoading() {
    document.getElementById('response').innerHTML = '<div class="text-center text-primary">⏳ Loading...</div>';
}

function showResponse(data) {
    document.getElementById('response').innerHTML = JSON.stringify(data, null, 2);
}

function showError(error) {
    document.getElementById('response').innerHTML = `<div class="text-danger">❌ Error: ${error.message}</div>`;
}

function clearResponse() {
    document.getElementById('response').innerHTML = '<em>Response cleared...</em>';
}

function copyResponse() {
    const responseText = document.getElementById('response').innerText;
    navigator.clipboard.writeText(responseText).then(() => {
        alert('Response copied to clipboard!');
    });
}
</script>
@endsection