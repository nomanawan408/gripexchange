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

@if(session()->has('error')) 
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif

{{--  success message --}}
@if(session()->has('success')) 
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('message')) 
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif


<div class="card">
	<div class="row pb-3">
		<h3>Email Verification </h3>
	</div>
	<div class="col-lg-6">
    <form method="POST" action="{{ route('verify.email.send') }}">
      @csrf
      <div class="mb-3">
          <label for="receiveremail" class="form-label">Email Address</label>
          <input type="email" readonly value="{{ Auth::user()->email }}" name="email" class="form-control" id="receiveremail" placeholder="Enter your Email" aria-describedby="receiveremail" required>
      </div>
      <button type="submit" class="btn btn-primary">Send Email Verfication Link</button>
  </form>
  
	</div>
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
