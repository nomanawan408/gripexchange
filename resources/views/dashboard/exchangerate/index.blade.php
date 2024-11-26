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
{{-- add session message.  --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
 

    <div class="card col-md-12">
        <div class="row pb-3">
            <h4>Buy/Sell/Exchange Rates | For More info Use <a href="https://www.exchangerate-api.com/" target="_blank">Gripexchange Exchange System</a>
            </h4>
          </div>
          <hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Method</th>
                <th scope="col">Buy</th>
                <th scope="col">Sell</th>
                <th scope="col">Deposit Fee	</th>
                <th scope="col">Deposit Fee	</th>
                @role('admin')
                <th scope="col">Action	</th>
                @endrole
              </tr>
            </thead>
            <tbody>
              @foreach($exchangeRates as $exchangeRate)
              <tr>
                  <!-- Access the title of the associated PaymentMethod -->
                  <th scope="row">{{ $exchangeRate->paymentMethod->title }}</th>
                  
                  <!-- Display Buy Rate -->
                  <td>PKR.{{ $exchangeRate->buy }}</td>
                  
                  <!-- Display Sell Rate -->
                  <td>PKR.{{ $exchangeRate->sell }}</td>
                  
                  <!-- Display Deposit Fee with correct format -->
                  @if($exchangeRate->deposit_fee_type == "percentage")
                      <td>{{ $exchangeRate->deposit_fee }} %</td>
                  @else
                      <td>PKR.{{ $exchangeRate->deposit_fee }}</td>
                  @endif
                  
                  <!-- Display Withdraw Fee with correct format -->
                  @if($exchangeRate->withdraw_fee_type == "percentage")
                      <td>{{ $exchangeRate->withdraw_fee }} %</td>
                  @else
                      <td>PKR.{{ $exchangeRate->withdraw_fee }}</td>
                  @endif
                  @role('admin')
                  <td><a href="{{ route('exchange-rates.edit', $exchangeRate) }}" class="btn btn-warning">Edit</a></td>
                  @endrole
              </tr>
          @endforeach
            
              
            </tbody>
          </table>
    </div>

@endsection
@push('custom-scripts')
    
@endpush
    
  
