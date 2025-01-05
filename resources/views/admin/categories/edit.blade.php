@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="my-3">
        <h1 class="mt-4 d-inline">Edit Categories</h1>
        <a href="{{ route('backend.categories.index') }}" class="btn btn-danger float-end">Cancel</a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.categories.index') }}">Categories</a></li>
        <li class="breadcrumb-item active">Edit Category</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Category
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('backend.categories.update', $category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Current Image</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button" role="tab" aria-controls="new_image-tab-pane" aria-selected="false">New Image</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-25 h-25 my-3" alt="{{ $category->name }}">
                            <input type="hidden" name="old_image" value="{{ $category->image }}">
                        </div>
                        <div class="tab-pane fade" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab" tabindex="0">
                            <input type="file" accept="image/*" class="form-control my-3 @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                        </div>
                    </div>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection