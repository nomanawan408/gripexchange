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

{{-- success message --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
  <section class="w-100 px-4 py-5"  style="background-image:url('https://img.pikbest.com/origin/09/32/77/pIkbEsT2rpIkbEsT4ZS.jpg!bw700'); background-size:cover; background-color: #9de2ff; border-radius: .5rem .5rem 0 0;">
    <div class="row d-flex justify-content-center" >
      <div class="col col-md-12 col-lg-12 col-xl-12">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex">
              <div class="flex-shrink-0">
                <img src="{{ $user->profile_picture ? asset('profile_pictures/' . $user->profile_picture) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
      alt="Profile Picture" class="img-fluid" style="width: 220px; height:180px; object-fit: cover; border-radius: 10px;">
              </div> 
              <div class="flex-grow-1 ms-3 d-flex justify-content-between flex-column">
                <div>
                  <h4 class="mb-1">{{ $user->name }}</h4>
                  
                </div>
                <div class="rounded-3 p-2 mb-2 bg-body-tertiary">
                                <h5>Email:</h5> <p class="mb-2 pb-1">{{ $user->email }} 
                                  @if($user->email_verified_at)
                                      <span class="text-success"><i>(verified)</i></span>
                                  @else
                                      <span class="text-danger"><i>(unverified)</i></span> <a href="{{ route('verification.index') }}">Verify your Email</a>
                                  @endif
                                </p>
                                <h5>Phone:</h5> <p class="mb-2 pb-1">{{ $user->phone_number }} 
                    {{-- <span class="text-success"><i>(verified)</i></span> <a href="#">Verify your Phone Number</a> --}}
                  </p>
                  <h5>Address:</h5> <p class="mb-2 pb-1"> {{ $user->city }}, {{ $user->country }}  </p>
                </div>
                <div class="">
                 <a href="{{ route('profile.edit', $user->id) }}"><button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Edit Profile</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
	
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
