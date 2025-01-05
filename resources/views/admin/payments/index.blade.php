@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="my-3">
        <h1 class="mt-4 d-inline">Payments</h1>
        <a href="{{ route('backend.payments.create') }}" class="btn btn-primary float-end">Create Payment</a>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Payments</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Payment List
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Payment Name</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $payment->name }}</td>
                            <td>
                                @if($payment->logo)
                                    <img src="{{ asset('storage/' . $payment->logo) }}" alt="Logo" class="img-fluid" style="max-width: 100px; height: auto;">
                                @else
                                    No Logo
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('backend.payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $payment->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $payments->links() }}
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>Are you sure you want to delete this payment?</h3>
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
        $('tbody').on('click', '.delete', function(){
            let id = $(this).data('id');
            $('#deleteForm').attr('action', '{{ route("backend.payments.destroy", ":id") }}'.replace(':id', id));
            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection
