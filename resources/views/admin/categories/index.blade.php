@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="my-3">
        <h1 class="mt-4 d-inline">Categories</h1>
        <a href="{{ route('backend.categories.create') }}" class="btn btn-primary float-end">Create Category</a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Categories</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Category List
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                @if($category->image)
                                    <img src="{{ asset('storage/'.$category->image) }}" 
                                         alt="{{ $category->name }}" 
                                         width="50" 
                                         height="50" 
                                         class="img-thumbnail"
                                         onerror="this.src='{{ asset('images/no-image.png') }}'; this.onerror=null;">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" 
                                         alt="No Image" 
                                         width="50" 
                                         height="50" 
                                         class="img-thumbnail">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('backend.categories.edit', $category->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger delete" 
                                        data-id="{{ $category->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>Are you sure to delete this category?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form action="" id="deleteForm" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        // Image error handling
        $('img').on('error', function(){
            $(this).attr('src', '{{ asset("images/no-image.png") }}');
        });

        // Delete functionality
        $('tbody').on('click', '.delete', function(){
            let id = $(this).data('id');
            $('#deleteForm').attr('action', `{{ route('backend.categories.index') }}/${id}`);
            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection