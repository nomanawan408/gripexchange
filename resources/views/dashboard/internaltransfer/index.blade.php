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

{{--  --}}

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{--  success message --}}
@if(session()->has('success')) 
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
 
@endif
<div class="card">
	<div class="row pb-3">
		<h3>Make Internal Transection within GripExchange </h3>
		<p>GripExchange to GripExchange Instant Fund Transfer
        </p>
	</div>
	<div class="col-lg-6">
    <form method="POST" action="{{ route('internal-transfer') }}">
      @csrf
  
      <div class="mb-3">
          <label for="receiveremail" class="form-label">Receiver Email</label>
          <input type="email" name="receiver_email" class="form-control" id="receiveremail" aria-describedby="receiveremail" required>
      </div>
      
      {{-- <div class="mb-3">
          <label for="currency" class="form-label">Select Currency</label>
          <select class="form-select" name="currency" id="currency" aria-label="currency" required>
              <option selected value="PKR">PKR</option>
          </select>
          @error('currency')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div> --}}

      <input type="hidden" name="currency" value="PKR" >

      <div class="mb-3">
          <label for="amount" class="form-label">Amount</label>
          <input type="text" name="amount" class="form-control" id="amount" aria-describedby="amount" required>
      </div>
  
      {{-- For Description --}}
      <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" name="description" class="form-control" id="description" aria-describedby="description">
      </div>
  
      {{-- For Transaction PIN --}}
      <div class="mb-3">
          <label for="transectionpin" class="form-label">Transaction PIN</label>
          <input type="password" name="transaction_pin" class="form-control" id="transectionpin" aria-describedby="transectionpin" required>
      </div>
  
      <button type="submit" class="btn btn-primary">Send Amount</button>
  </form>
  
	</div>
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
