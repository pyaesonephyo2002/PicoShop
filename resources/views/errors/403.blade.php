@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>403 - Unauthorized Access</h1>
        <p>You do not have permission to access this page.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Back</a>
    </div>
@endsection
