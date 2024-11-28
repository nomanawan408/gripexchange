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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="cards_container px-2">	
	<div class="card col-12">
		<div class="card-body">
			<h4 class="card-title">Fund Withdraw to {{ $paymentMethod->title }}</h4>
			<p class="card-text">Please select Currency and Enter Amount</p>
			<p class="text-danger fw-bold">Note: Provide the correct wallet address. The company will not be responsible for any issues caused by an incorrect address.</p>
			<form class="needs-validation" method="POST" action="{{ route('withdraw.store') }}" enctype="multipart/form-data" novalidate>
				@csrf
				<input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id }}">
				<div class="row g-3">
					<div class="col-12 col-md-6">
						<input type="hidden" name="currency" value="pkr">	 	
						
						<div class="mb-3">
							<label for="customer_account_number" class="form-label">Receiver Wallet Address</label>
							<input type="text" name="customer_account_number" class="form-control" id="customer_account_number" aria-describedby="accountnumber" required>
							@error('customer_account_number')
								<div class="invalid-feedback d-block">
									{{ $message }}
								</div>
							@enderror
						</div>	
						<div class="mb-3">
							<label for="description" class="form-label">Description</label>
							<textarea name="description" class="form-control" id="description" rows="3"></textarea>
							@error('description')
								<div class="invalid-feedback d-block">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>
			
					<div class="col-12 col-md-6">
						<div class="mb-3">
							<label for="amount" class="form-label">Enter Amount</label>
							<input type="number" name="amount" class="form-control" id="amount" aria-describedby="amount" required>
							@error('amount')
								<div class="invalid-feedback d-block">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-primary w-100 mt-3" onclick="this.disabled=true;this.innerHTML='Processing, please wait...';this.form.submit();">Withdraw Fund</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@push('custom-scripts')
<script>
	// Form validation
	(function () {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation')
		Array.prototype.slice.call(forms)
			.forEach(function (form) {
				form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}
					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>
@endpush