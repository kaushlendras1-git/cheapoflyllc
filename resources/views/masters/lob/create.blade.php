@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Lobs</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" href="{{ route('lobs.index') }}">Lobs</a>
            <a aria-current="page">Add Lobs</a>
        </div>
    </div>

    <div class="row">

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ isset($lob) ? route('lobs.update', $lob->id) : route('lobs.store') }}">
            @csrf
            @if(isset($lob))
            @method('PUT')
            @endif

            <div class="card p-4 mb-4">
                <div class="row mb-3 payment-form booking-form gen_form">
                    <div class="col-md-3 position-relative">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name', $lob->name ?? '') }}" required>
                    </div>

                    

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

        </form>


    </div>


    <!--/ Content -->
    @endsection