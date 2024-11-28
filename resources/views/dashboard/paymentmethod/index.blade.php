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
    <div class="card col-md-12">
        <div class="pb-3 justify-content-between" style="display:flex;">
            <h3>Payment Methods</h3>
            <a href="{{ url('paymentmethod/create') }}" >
              <button class="btn btn-primary">Add New</button>
            </a>
        </div>
        <hr>
        @if($paymentMethods->isEmpty())
          <p>No payment methods available.</p>
        @else
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="col-lg-2">Account</th>
                    <th>Details</th>
                    <th>Exchange Rate</th>
                    <th >Account Holder Name</th>
                    <th>Account Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentMethods as $paymentMethod)
                    @if($paymentMethod->slug != 'internal-transfer')
                    <tr>
                        <td>{{ $paymentMethod->id }}</td>
                        <td class="d-flex" style="gap:20px">
                          <div class="table_img_container">
                            <img src="{{ asset('img/' . $paymentMethod->image) }}" alt="{{ $paymentMethod->title }}">
                          </div>
                          {{ $paymentMethod->title }}
                        </td>
                        <td>{{ $paymentMethod->details }}</td>
                        <td>{{ $paymentMethod->exchange_rate }}</td>
                        <td>{{ $paymentMethod->account_holder_name }}</td>
                        <td>{{ $paymentMethod->account_number }}</td>
                        <td class="d-flex" style="gap:10px">
                            <a href="{{ route('paymentmethod.edit', $paymentMethod) }}" class="badge text-bg-warning">Edit</a>
                            <form action="{{ route('paymentmethod.destroy', $paymentMethod->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="badge text-bg-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        </div>
        @endif
    </div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
