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
        @if($users->isEmpty())
          <p>No users available.</p>
        @else
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Identity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->city ?? 'n/a' }}</td>
                    <td>
                        @if($user->cnic_front && $user->cnic_back)
                            <a href="{{ asset('identity/' . $user->id . '/' . $user->cnic_front) }}" target="_blank">View Front</a>
                            <a href="{{ asset('identity/' . $user->id . '/' . $user->cnic_back) }}" target="_blank">View Back</a>
                        @else
                            <span>Not verified yet</span>
                        @endif
                    </td>
                    <td class="d-flex" style="gap:10px">
                        <form action="{{ route('users.update-cnic-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="pending" {{ $user->cnic_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $user->cnic_status == 'approved' ? 'selected' : '' }}>Approve</option>
                                <option value="rejected" {{ $user->cnic_status == 'rejected' ? 'selected' : '' }}>Reject</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        @endif
    </div>
@endsection
@push('custom-scripts')
    
@endpush