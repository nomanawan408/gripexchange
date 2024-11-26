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
@endif
<div class="card">
	<div class="row pb-3">
		<h3>Select Payment Method to Deposit</h3>
		<p>Select any Payment Method to deposit your money </p>
	</div>
	<div class="col-lg-12">
		<div class="payment_method_card_section">
			@foreach($paymentMethods as $paymentMethod)
				@if ($paymentMethod->slug != 'internal-transfer')
					<a href="{{ route('deposit.accountdetails', $paymentMethod->slug) }}">
						<div class="payment_method_card">
							<img src="{{ asset('img/' . $paymentMethod->image) }}" alt="{{ $paymentMethod->methodname }}">
						</div>
						<div class="text-center">
							<span>{{ $paymentMethod->title }}</span>
						</div>
					</a>
				@endif
			@endforeach
		</div>
	</div>
</div>



@endsection
@push('custom-scripts')
    
@endpush
    
  
