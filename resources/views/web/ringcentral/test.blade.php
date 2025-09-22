@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">RingCentral Integration Test</h5>
                    <p class="text-muted">Your Extension: {{ auth()->user()->extension ?? 'Not Set' }}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Test Functions</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" onclick="testIncomingCalls()">Get My Incoming Calls</button>
                                <button class="btn btn-info" onclick="testCallLogs()">Get Call Logs</button>
                                <button class="btn btn-success" onclick="testSMS()">Test SMS</button>
                                <button class="btn btn-warning" onclick="testCall()">Test Call</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Response</h6>
                            <div id="response" class="border p-3" style="height: 300px; overflow-y: auto; background-color: #f8f9fa;">
                                <em>Click a button to test RingCentral integration...</em>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function testIncomingCalls() {
    showLoading();
    fetch('{{ route("ringcentral.incoming-calls") }}')
        .then(response => response.json())
        .then(data => showResponse(data))
        .catch(error => showError(error));
}

function testCallLogs() {
    showLoading();
    fetch('{{ route("ringcentral.call-logs") }}')
        .then(response => response.json())
        .then(data => showResponse(data))
        .catch(error => showError(error));
}

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

function showLoading() {
    document.getElementById('response').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div><br>Loading...</div>';
}

function showResponse(data) {
    document.getElementById('response').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
}

function showError(error) {
    document.getElementById('response').innerHTML = '<div class="text-danger">Error: ' + error.message + '</div>';
}
</script>
@endsection