<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>
<body>
	
</body>
</html>



@extends('dashboard.layouts.app')
@section('main-content')

{{-- Display success message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('error'))
    {{-- Display error message --}}
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="row pb-3">
        <h3>Reset Wallet Pin</h3>
        <p>Create New 5-digit PIN to set up your account</p>
    </div>
    <div class="col-lg-6">
        <form method="POST" action="{{ route('wallet.resetPin') }}">
            @csrf
            <div class="mb-3">
                <label for="current_pin" class="form-label">Current PIN</label>
                <input type="password" maxlength="5" name="current_pin" class="form-control @error('current_pin') is-invalid @enderror" id="current_pin">
                @error('current_pin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_pin" class="form-label">New PIN</label>
                <input type="password" maxlength="5" name="new_pin" class="form-control @error('new_pin') is-invalid @enderror" id="new_pin">
                @error('new_pin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_pin_confirmation" class="form-label">Confirm New PIN</label>
                <input type="password" name="new_pin_confirmation" maxlength="5" class="form-control @error('new_pin_confirmation') is-invalid @enderror" id="new_pin_confirmation">
                @error('new_pin_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Reset PIN</button>
        </form>
	</div>
</div>
@endsection
@push('custom-scripts')
    
@endpush
    