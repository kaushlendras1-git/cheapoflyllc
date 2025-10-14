@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Zoho Sign - Send Document</h2>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('zoho-sign.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Request Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="request_name" value="{{ old('request_name') }}" required>
                                @error('request_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Recipient Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="recipient_email" value="{{ old('recipient_email') }}" required>
                                @error('recipient_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Recipient Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="recipient_name" value="{{ old('recipient_name') }}" required>
                                @error('recipient_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Document (PDF) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="document" accept=".pdf" required>
                                @error('document')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Private Notes</label>
                                <textarea class="form-control" name="private_notes" rows="3">{{ old('private_notes') }}</textarea>
                                @error('private_notes')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Send for Signature</button>
                                <button type="submit" formaction="{{ route('zoho-sign.test-static') }}" class="btn btn-warning">Test with Static PDF</button>
                                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection