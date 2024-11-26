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

  {{-- message --}}
  @if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
    </div>
  @endif
   
  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">
      {{ Session::get('success') }}
  </div>
@endif
    <div class="card col-md-12">
        <div class="row pb-3">
            <h3>Account Verifications <span style="font-style:italic;font-size:20px"></h3>
            </p>
        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Method</th>
                <th scope="col">Status	</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Complete Profile</th>
                <td>
                    @if(empty(Auth::user()->email) || empty(Auth::user()->phone_number) || empty(Auth::user()->country) || empty(Auth::user()->city))
                        <span class="badge bg-danger">Incomplete</span>
                    @else
                        <span class="badge bg-success">Completed</span>
                    @endif
                </td>
                <td>
                  @if(empty(Auth::user()->email) || empty(Auth::user()->phone_number) || empty(Auth::user()->country) || empty(Auth::user()->city))
                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="text-light text-decoration-none">
                      <button class="btn btn-success" >Complete Now </span>
                    </a>
                  @endif
                </td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>
                    @if (Auth::user()->hasVerifiedEmail())
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-danger">Unverified</span>
                    @endif

                </td>
                <td>
                  @if (Auth::user()->hasVerifiedEmail())
                    {{-- <span class="badge bg-success">Verified</span> --}}
                  @else
                    <a href="{{ route('verify.email') }}" class="text-light text-decoration-none">
                      <button class="btn btn-success" >Varify Now </span>
                    </a>
                  @endif
                </td>
              </tr>
              {{-- <tr>
                <th scope="row">Phone (25%)</th>
                <td>
                    @if (Auth::user()->phone_verified_at != null)
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-danger">Unverified</span>
                    @endif
                </td>
                <td>
                  @if (Auth::user()->phone_verified_at == null)
                    <a href="{{ route('verify.phone') }}" class="text-light text-decoration-none">
                      <button class="btn btn-success" >Varify Now </span>
                    </a>
                  @endif
                </td>
              </tr> --}}
              <tr>
                <th scope="row">Identity</th>
                <td>
                    @if (Auth::user()->cnic_front != null && Auth::user()->cnic_back != null && Auth::user()->cnic_status == 'approved')
                        <span class="badge bg-success">Verified</span>
                    @elseif (Auth::user()->cnic_front != null && Auth::user()->cnic_back != null && Auth::user()->cnic_status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @else
                        <span class="badge bg-danger">Unverified</span>
                    @endif                </td>
                <td>
                  @if (Auth::user()->cnic_front == null || Auth::user()->cnic_back == null || Auth::user()->cnic_status != 'approved')
                    <a href="{{ route('verify.identity') }}" class="text-light text-decoration-none">
                      <button class="btn btn-success" >Varify Now </span>
                    </a>
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
    </div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
