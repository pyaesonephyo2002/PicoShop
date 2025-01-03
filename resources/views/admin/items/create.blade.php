@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="my-3">
        <h1 class="mt-4 d-inline">Items</h1>
        <a href="{{route('backend.items.index')}}" class="btn btn-danger float-end">Cancel</a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.items.index') }}">Items</a></li>
        <li class="breadcrumb-item active">Item Create</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Create Item
        </div>
        <div class="card-body">
            <form method="post" action="{{route('backend.items.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="codeNo" class="form-label">Code No:</label>
                    <input type="text" class="form-control @error('code_no') is-invalid @enderror" id="code" name="code_no" value="{{old('code_no')}}">
                    @error('code_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" accept="image/*" class="form-control  @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{old('discount')}}">
                    @error('discount')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inStock" class="form-label">InStock:</label>
                    <select class="form-select @error('instock') is-invalid @enderror" id="inStock" name="instock" value="{{old('instock')}}" >
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('instock')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category" name="category_id">
                        <option value="">Choose Category</option>
                        @foreach($categories as $category)
                          <option value="{{$category->id}}"  {{old('category_id') == $category->id ?
                            'selected':'';}}>{{$category->name}}</option>    
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{old('description')}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
