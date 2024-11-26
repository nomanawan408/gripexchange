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

{{--  success message --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	{{ session('success') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



{{-- get the email verification verfied email message --}}


<div class=" cards_container gap-3">	
	<div class="state_card card " style="background-color: rgb(150, 9, 9) !important;">
		<h4>Available Balance(<i>$USD</i>)</h4>
		<h1>{{ $totalBalance }}</h1>
  
	</div> 
	<div class="state_card card " style="background-color: rgb(14, 53, 79) !important;">
		<h4>Total Deposit(<i>$USD</i>)</h4>
		<h1>{{ $totalDeposits }}</h1>

	</div> 
	<div class="state_card card">
		<h4>Total Withdraw(<i>$USD</i>)</h4>
		<h1> {{ $totalWidthdraw }}</h1>
	</div> 
	<div class="state_card card" style="background-color: rgb(99, 23, 47) !important;">
		<h4>Daily Profit(<i>$USD</i>)</h4>
		<h1> {{ $daily_profit}}</h1>
	</div> 
	<div class="state_card card" style="background-color: rgb(9, 84, 80) !important;">
		<h4>Total Profit(<i>$USD</i>)</h4>
		<h1> {{ $total_profit }}</h1>
	</div>
</div>

<div class="col-lg-12 d-flex flex-wrap w-100 my-3 gap-3">
	<div class="card @cannot('manage users') w-100 @else col-md-12 @endcannot">
		<div class="row pb-3">
			<h4>Recent Transections</h4>
			<hr>
		</div>
		<table class="table table-striped table-responsive">
			<thead>
			<tr>
				<th scope="col">Date/Time </th>
				<th scope="col">Transection Details</th>
				<th scope="col">Amount</th>
				<th scope="col">Upload</th>
                <th scope="col">Status</th>
				@role('admin')
				<th scope="col">Action</th>
				@endrole
				
			</tr>
			</thead>
			<tbody>
				@if(count($recentTransections) > 0)
					@foreach($recentTransections as $transection)
					<tr>
						<td>{{ $transection->created_at->format('d-m-Y h:i A') }}</td>
						<td>
							@if($transection->deposit)
								Deposit via {{ $transection->paymentMethod->title }}
							@elseif($transection->withdraw)
								Withdrawal via {{ $transection->paymentMethod->title }}
							@elseif($transection->internalTransfer)
								Internal Transfer via {{ $transection->paymentMethod->title }}
							@else
								Deposite via Daily Profit
							@endif
						</td>
						<td>{{ $transection->amount }}</td>
						<td>
							@if($transection->receipt_path)
							<a href="{{ asset('receipt/' . $transection->receipt_path) }}" class="badge text-bg-success text-decoration-none" target="_blank">View Receipt</a>
							@else
								<span class="badge text-bg-secondary">No Receipt</span>
							@endif
						</td>

				  
				  <td>
					  @switch($transection->status)
						  @case('pending')
							  <span class="badge alert alert-secondary p-1 px-2">Pending</span>
							  @break
						  @case('approved')
							  <span class="badge alert alert-success p-1 px-2">Approved</span>
							  @break
						  @case('rejected')
							  <span class="badge alert alert-danger p-1 px-2">Rejected</span>
							  @break
					  @endswitch
				  </td>
				  @role('admin')
				  <td>
					  @if ($transection->status == 'pending')
						  <form action="{{ route('account-statements.approve', $transection->id) }}" method="POST" style="display:inline-block;">
							  @csrf
							  <button type="submit" class="badge text-bg-success">Approve</button>
						  </form>
						  <form action="{{ route('account-statements.reject', $transection->id) }}" method="POST" style="display:inline-block;">
							  @csrf
							  <button type="submit" class="badge text-bg-danger">Reject</button>
						  </form>
					  </td>
					  @endif
				  @endrole
				</tr>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="4" class="text-center">No transactions found</td>
					</tr>
				@endif
			</tbody>		
		</table>
	</div>
	@can('manage users')
	<div class="card col-md-12">
		<div class="row pb-3">
			<h4>Recent Users</h4>
			<hr>
		</div>
	
		<table class="table table-striped table-responsive-md">
			<thead>
			<tr>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Phone</th>
				
			</tr>
			</thead>
			<tbody>
				@foreach($recentUsers as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->phone_number }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endcan
</div>
@endsection
@push('custom-scripts')
    
@endpush
    
  
