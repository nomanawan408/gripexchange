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
<div class="card">
  
	<div class="row pb-3">
		<h3>Edit Exchange Rates of {{ $exchangeRate->paymentMethod->title }}
    </h3>
		<p>Update Exchange rates of the Payment Methods

        </p>
        <hr>
	</div>
    <div class="col-lg-12">
    <form method="POST" action="{{ route('exchange-rates.update', $exchangeRate->id) }}">
    @csrf
    @method('PUT')

    <div class="row col-lg-12">
        <div class="col-lg-6">
           
           <div class="mb-3">
            <label for="buy" class="form-label">Buy Rate</label>
            <input type="text" name="buy" id="buy" class="form-control" value="{{ old('buy', $exchangeRate->buy) }}" required>
            </div>
            

            <div class="mb-3">
                <label for="deposit_fee" class="form-label">Deposit Fee</label>
                <input type="text" name="deposit_fee" id="deposit_fee" class="form-control" value="{{ old('deposit_fee', $exchangeRate->deposit_fee) }}" required>
            </div>

            <div class="mb-3">
                <label for="withdraw_fee" class="form-label">Withdraw Fee</label>
                <input type="text" name="withdraw_fee" id="withdraw_fee" class="form-control" value="{{ old('withdraw_fee', $exchangeRate->withdraw_fee) }}" required>
            </div>

        </div>
        <div class="col-lg-6">
         {{--  --}}
         <div class="mb-3">
            <label for="sell" class="form-label">Sell Rate</label>
            <input type="text" name="sell" id="sell" class="form-control" value="{{ old('sell', $exchangeRate->sell) }}" required>
        </div>
        
    <div class="mb-3">
        <label for="deposit_fee_type" class="form-label">Deposit Fee Type</label>
        <select name="deposit_fee_type" id="deposit_fee_type" class="form-select" required>
            <option value="fixed" {{ old('deposit_fee_type', $exchangeRate->deposit_fee_type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
            <option value="percentage" {{ old('deposit_fee_type', $exchangeRate->deposit_fee_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="withdraw_fee_type" class="form-label">Withdraw Fee Type</label>
        <select name="withdraw_fee_type" id="withdraw_fee_type" class="form-select" required>
            <option value="fixed" {{ old('withdraw_fee_type', $exchangeRate->withdraw_fee_type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
            <option value="percentage" {{ old('withdraw_fee_type', $exchangeRate->withdraw_fee_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
        </select>
    </div>

        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Exchange Rate</button>
</form>
</div>
    </div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
