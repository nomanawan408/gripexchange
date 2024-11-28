<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Account Details</title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>
<body>

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

<div class="cards_container">	
	<div class="state_card card btn-primary text-light py-3">
		<h4 class="h4">Account Details</h4>
		<p class="mb-2">We will only accept for this deposit USDT TRC-20 on the TRON Network.</p>
		<p class="mb-2">To deposit funds, make a transfer to the blockchain address below. Copy the address or scan the QR code with the camera on your phone.</p>
		
		<p class="fw-bold text-warning mb-3">Please first transfer the amount to our below account and then fill and submit the form below to deposit amount.</p> 
		<div class="table-responsive">
			<table class="table table-striped p-4 rounded rounded-lg">
				<thead>
					<tr>
						<th scope="col">{{ $paymentMethod->details }}</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					@if($paymentMethod->account_holder_name != '-')
					<tr>
						<td scope="row">Account Name</td>
						<td scope="row">{{ $paymentMethod->account_holder_name }}</td>
					</tr>
					@endif
					<tr>
						<td scope="row">Account Number</td>
						<td scope="row">
							<div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
								<span id="accountNumber" class="text-break">{{ $paymentMethod->account_number }}</span>
								<div class="input-group-append">
									<button class="btn btn-outline-primary btn-sm" onclick="copyAccountNumber()">Copy Account Number</button>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div> 

	<div class="card col-12">
		<h4 class="h4">Fund Deposit</h4>
		<p>Please select Currency and Enter Amount</p>
		<form class="row" method="POST" action="{{ route('deposit.store') }}" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id }}">
			<div class="cards_container">
				<div class="col-12 col-md-5">
					<input type="hidden" name="currency" value="pkr">	 	
						
					<div class="mb-3">
						<label for="transaction_id" class="form-label">Transaction ID</label>
						<input type="text" name="customer_transaction_id" class="form-control @error('customer_transaction_id') is-invalid @enderror" id="transaction_id" required>
						@error('customer_transaction_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="mb-3">
						<label for="transaction_date" class="form-label">Transaction Date & Time</label>
						<input type="datetime-local" name="transaction_datetime" class="form-control @error('transaction_datetime') is-invalid @enderror" id="transaction_date" required>
						@error('transaction_datetime')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
		
				<div class="col-12 col-md-6">
					<div class="mb-3">
						<label for="amount" class="form-label">Enter Amount</label>
						<input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" required>
						@error('amount')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="mb-3">
						<label for="receipt" class="form-label">Upload Receipt</label>
						<input type="file" name="receipt" class="form-control @error('receipt') is-invalid @enderror" id="receipt" required>
						@error('receipt')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="col-12">
					<button type="submit" class="btn btn-primary w-100 w-md-auto" onclick="this.disabled=true;this.innerHTML='Processing, please wait...';this.form.submit();">Deposit</button>
				</div>
			</div>
		</form>
	</div> 
</div>

@endsection

@push('custom-scripts')
<script>
function copyAccountNumber() {
	const accountNumber = document.getElementById("accountNumber").innerText;
	navigator.clipboard.writeText(accountNumber).then(function() {
		alert("Account number copied!");
	}).catch(function() {
		const textarea = document.createElement("textarea");
		textarea.value = accountNumber;
		document.body.appendChild(textarea);
		textarea.select();
		document.execCommand("copy");
		document.body.removeChild(textarea);
		alert("Account number copied!");
	});
}
</script>
@endpush

</body>
</html>