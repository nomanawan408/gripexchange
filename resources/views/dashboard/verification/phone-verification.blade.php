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
		<h3>Phone Number Verification </h3>
	</div>
	<div class="col-lg-6">
        <form method="POST" action="{{ route('verify.phone.store') }}" id="phoneVerificationForm">
            @csrf
            <div class="input-group mb-3">
                <input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="03xx-xxxxxxx" pattern="03[0-9]{2}-[0-9]{7}" aria-label="Phone number" required>
                <button class="btn btn-dark" type="button" id="sendCodeButton">Send Verification Code</button>
            </div>
            <div class="mb-3">
                <label for="phone_code" class="form-label">Phone Verification Code</label>
                <input type="text" name="phone_code" class="form-control" id="phone_code" placeholder="Enter your phone verification code" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify Phone</button>
        </form>
	</div>
</div>

<script>
    document.getElementById('sendCodeButton').addEventListener('click', function () {
        const phoneNumber = document.getElementById('phone_number').value;

        fetch('{{ route("send.verification.code") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ phone_number: phoneNumber })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Verification code sent successfully!');
            } else {
                alert('Error sending verification code.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection

  
