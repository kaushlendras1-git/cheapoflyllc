@extends('web.layouts.main')
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Add Payment Staus</h2>
        <div class="breadcrumb">
                <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
                <a class="active" href="{{ route('payment-status.index') }}">Add Payment Status</a>
                <a aria-current="page">Add Payment Status</a>
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
                <div class="row mb-3 payment-form">
             <div class="col-md-3 position-relative">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $lob->name ?? '') }}" required>
            </div>

             <div class="col-md-3 position-relative">
            <label>User (Reference)</label>
            <select name="user_id" required  class="form-control">
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($lob) && $lob->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
             </div>

             <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

        </form>


    </div>


    <!--/ Content -->
    @endsection