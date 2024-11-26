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
<div class="card">
	<div class="row pb-3">
		<h2>Edit Payment Method</h2>
		<p>Fill up the form to edit payment method</p>
	</div>
    
	<form class="row" method="POST" action="{{ route('paymentmethod.update', $paymentMethod->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <div class="mb-3">
                <label for="methodname" class="form-label">Payment Method Title</label>
                <input type="text" name="methodname" class="form-control" placeholder="Enter Payment Method Name" id="methodname" value="{{ old('methodname', $paymentMethod->title) }}" aria-describedby="methodname">
                @error('methodname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror        
            </div>
            
            <div class="mb-3">
                <label for="exchange_rate" class="form-label">Exchange Rate</label>
                <input type="number" placeholder="Enter Exchange Rate" name="exchange_rate" class="form-control" id="exchange_rate" value="{{ old('exchange_rate', $paymentMethod->exchange_rate) }}" aria-describedby="exchange_rate">
                @error('exchange_rate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="account_holder_name" class="form-label">Account Holder Title</label>
                <input type="text" name="account_holder_name" class="form-control" placeholder="Enter Account Holder Name" id="account_holder_name" value="{{ old('account_holder_name', $paymentMethod->account_holder_name) }}" aria-describedby="account_holder_name">
                @error('account_holder_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Update Account</button>   
        </div>
        
        <div class="col-md-6">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" placeholder="Enter Description" class="form-control" id="description" value="{{ old('description', $paymentMethod->details) }}" aria-describedby="description">
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image" aria-describedby="image">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="account_number" class="form-label">Account Number</label>
                <input type="text" name="account_number" placeholder="Enter Account Number" class="form-control" id="account_number" value="{{ old('account_number', $paymentMethod->account_number) }}" aria-describedby="account_number">
                @error('account_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </form>
    
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
