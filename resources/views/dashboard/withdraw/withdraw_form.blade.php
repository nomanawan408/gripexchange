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
<div class="cards_container ">	
	<div class=" card col-12">
		<h4>Fund Widthdraw to {{ $paymentMethod->title }}</h4>
		<p>Please select Currency and Enter Amount</p>
		<p style="color:red;font-weight:bold">Note: Provide the correct wallet address. The company will not be responsible for any issues caused by an incorrect address.</p>
		<form class="row" method="POST" action="{{ route('withdraw.store') }}" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id }}">
			<div class="cards_container">
				<div class="col-5">
					<input type="hidden" name="currency" value="pkr">	 	
					
					<div class="mb-3">
						<label for="customer_account_number" class="form-label">Receiver Wallet Address</label>
						<input type="text" name="customer_account_number" class="form-control" id="customer_account_number" aria-describedby="accountnumber" required>
						@error('customer_account_number')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>	
					<div class="mb-3">
						<label for="description" class="form-label">Description</label>
						<textarea name="description" class="form-control" id="description"></textarea>
						@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					
				</div>
		
				<div class="col-6">
					<div class="mb-3">
						<label for="amount" class="form-label">Enter Amount</label>
						<input type="number" name="amount" class="form-control" id="amount" aria-describedby="amount" required>
						@error('amount')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
		
					
				</div>
				<button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.innerHTML='Processing, please wait...';this.form.submit();">Widthdraw Fund</button>
			</div>
		</form>
		
	</div> 
	
	
</div>

@endsection
@push('custom-scripts')
    
@endpush
    
  
