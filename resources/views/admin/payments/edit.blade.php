@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="my-3">
        <h1 class="mt-4">Edit Payment</h1>
        <a href="{{ route('backend.payments.index') }}" class="btn btn-danger float-end">Cancel</a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.payments.index') }}">Payments</a></li>
        <li class="breadcrumb-item active">Edit Payment</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Payment
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('backend.payments.update', $payment->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Payment Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $payment->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="mb-3">
                    <ul class="nav nav-tabs" id="logoTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="currentLogo-tab" data-bs-toggle="tab" data-bs-target="#currentLogo" type="button" role="tab" aria-controls="currentLogo" aria-selected="true">Current Logo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="newLogo-tab" data-bs-toggle="tab" data-bs-target="#newLogo" type="button" role="tab" aria-controls="newLogo" aria-selected="false">New Logo</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="logoTabContent">
                        <div class="tab-pane fade show active" id="currentLogo" role="tabpanel" aria-labelledby="currentLogo-tab">
                            @if ($payment->logo)
                                <img src="{{ asset('storage/' . $payment->logo) }}" class="w-25 h-25 my-3" alt="{{ $payment->name }}">
                            @else
                                No logo available
                            @endif
                        </div>
                        <div class="tab-pane fade" id="newLogo" role="tabpanel" aria-labelledby="newLogo-tab">
                            <input type="file" accept="image/*" class="form-control my-3 @error('logo') is-invalid @enderror" name="logo">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
