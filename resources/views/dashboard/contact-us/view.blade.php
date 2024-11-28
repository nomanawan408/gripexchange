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
      
        <hr>
        @if($contact->isEmpty())
          <p>No Record available.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contact as $mail)
                <tr>
                    <td>{{ $mail->id }}</td>
                    <td>{{ $mail->name }}</td>
                    <td>{{ $mail->email }}</td>
                    <td>{{ $mail->subject ?? 'n/a' }}</td>
                    <td>{{ $mail->message }}</td>
                    <td>{{ $mail->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif    </div>
@endsection
@push('custom-scripts')
    
@endpush