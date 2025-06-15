@extends('web.layouts.main')
@section('content')

@section('head')

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/highlight/highlight.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection

            
              
@endsection


@section('footer')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/highlight/highlight.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/forms-editors.js') }}"></script>
@endsection



