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

{{-- create validation error message --}}
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
		<h3>Edit Profile</h3>
		<p class="text-danger"><b><i>Complete your profile by filling all your details below to get access your account.
        </i></b></p>
	</div>
	<div class="col-lg-12">
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      <div class="row col-lg-12">
          <div class="col-lg-5">
              <div class="mb-3">
                  <label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" required class="form-control" id="fullname" value="{{ old('name', $user->name) }}" aria-describedby="fullname">
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                  <select class="form-select"  required name="country" id="country" aria-label="country">
                      <option value="Pakistan" {{ old('country', $user->country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                      <option value="India" {{ old('country', $user->country) == 'India' ? 'selected' : '' }}>India</option>
                      <option value="Europe" {{ old('country', $user->country) == 'Europe' ? 'selected' : '' }}>Europe</option>
                      <option value="China" {{ old('country', $user->country) == 'China' ? 'selected' : '' }}>China</option>
                  </select>
                  @error('country')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
  
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="text" required name="email" class="form-control" readonly id="email" value="{{ old('email', $user->email) }}" aria-describedby="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                  </div>
          </div>
          <div class="col-lg-5">
            
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" required name="phone_number" class="form-control" id="phonenumber" value="{{ old('phone_number', $user->phone_number) }}" aria-describedby="phonenumber">
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                <input type="text" required name="city" class="form-control" id="city" value="{{ old('city', $user->city) }}" aria-describedby="city">
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>



            <div class="mb-3">
                <label for="transactionpin" class="form-label">Transaction PIN <span class="text-danger">*</span></label>
                <input type="password" required name="transactionpin" placeholder="Enter your transection PIN" class="form-control" id="transactionpin" aria-describedby="transactionpin">
                @error('transactionpin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
              
          </div>
      </div>
  
      <button type="submit" class="btn btn-primary">Update Profile</button>   
  </form>
  
	</div>
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
