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
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	{{ session('success') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
{{-- error --}}
@elseif (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	{{ session('error') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
<div class="card">
	<div class="row pb-3">
		<h3>Set Transaction Pin</h3>
		<p>Create New 5-digit PIN to set up your account</p>
	</div>
	<div class="col-lg-6">
	<form method="POST" action="{{ route('wallet.storePin') }}">
		@csrf
		<div class="mb-3">
		  <label for="pin" class="form-label">New PIN</label>
		  <input type="password" maxlength="5" name="pin" class="form-control" id="pin" aria-describedby="setuppin">
		  @error('pin')
		  <span class="invalid-feedback" role="alert">
			  <strong>{{ $message }}</strong>
		  </span>
	  	@enderror
		</div>
		<div class="mb-3">
		  <label for="confirmpin" class="form-label">Confirm PIN</label>
		  <input type="password" name="pin_confirmation"  maxlength="5" class="form-control" id="confirmpin" aria-describedby="setuppin">
		  @error('pin_confirmation')
		  <span class="invalid-feedback" role="alert">
			  <strong>{{ $message }}</strong>
		  </span>
	  @enderror
		</div>
		
		<button type="submit" class="btn btn-primary">Setup PIN</button>
	  </form>
	</div>
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
