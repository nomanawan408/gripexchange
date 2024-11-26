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
		<h3>Identity Verification </h3>
	</div>
	<div class="col-lg-6">
    <form method="POST" action="{{ route('verify.identity.store') }}"  enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
          <label for="cnic_front" class="form-label">CNIC Front</label>
          <input type="file" name="cnic_front" class="form-control" id="cnic_front" placeholder="Enter your CNIC Front" aria-describedby="cnic_front" accept=".jpg,.jpeg,.png,.pdf" required>
      </div>
      <div class="mb-3">
          <label for="cnic_back" class="form-label">CNIC Back</label>
          <input type="file" name="cnic_back" class="form-control" id="cnic_back" placeholder="Enter your CNIC Back" aria-describedby="cnic_back" accept=".jpg,.jpeg,.png,.pdf" required>
      </div>      <button type="submit" class="btn btn-primary">Submit Identity</button>
  </form>
  
	</div>
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
