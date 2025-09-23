@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">RingCentral Integration Video Tutorials</h5>
                    <p class="text-muted">Step-by-step video guides for RingCentral setup and usage</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Tutorial Videos -->
                        <div class="col-md-6">
                            <h6>📹 Setup & Configuration</h6>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">RingCentral API Setup</h6>
                                    <p class="card-text">Learn how to create RingCentral developer account and get API credentials</p>
                                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="ri ri-youtube-line"></i> Watch Tutorial
                                    </a>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Extension Management</h6>
                                    <p class="card-text">How to assign extensions to users and manage call routing</p>
                                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="ri ri-youtube-line"></i> Watch Tutorial
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6>🔧 Testing & Usage</h6>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">API Testing with Postman</h6>
                                    <p class="card-text">Complete guide to test RingCentral APIs using Postman collections</p>
                                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="ri ri-youtube-line"></i> Watch Tutorial
                                    </a>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Webhook Configuration</h6>
                                    <p class="card-text">Set up webhooks for real-time call notifications</p>
                                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="ri ri-youtube-line"></i> Watch Tutorial
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6>📚 Additional Resources</h6>
                                <ul class="mb-0">
                                    <li><a href="https://developers.ringcentral.com/" target="_blank">RingCentral Developer Portal</a></li>
                                    <li><a href="https://developers.ringcentral.com/api-reference" target="_blank">API Documentation</a></li>
                                    <li><a href="https://github.com/ringcentral" target="_blank">GitHub Examples</a></li>
                                    <li><a href="https://community.ringcentral.com/" target="_blank">Developer Community</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Code -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6>💻 Sample Code Examples</h6>
                            <div class="card">
                                <div class="card-body">
                                    <pre><code>// Get user by extension
fetch('/ringcentral/user-by-extension/1001')
  .then(response => response.json())
  .then(data => console.log(data));

// Test webhook
const webhookData = {
  body: {
    to: { extensionNumber: "1001" },
    from: { phoneNumber: "+1234567890" },
    direction: "Inbound"
  }
};

fetch('/ringcentral/webhook/incoming-call', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify(webhookData)
});</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection