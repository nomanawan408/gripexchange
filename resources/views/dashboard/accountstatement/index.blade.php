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
   
<div class="row col-lg-12 gap-3 flex-nowrap">
    <div class="card col-md-12 p-4">
        <div class=" pb-3">
            <h3>Account Statement and report</h3>
            <p>Please select date</p>
        </div>
        <div class="col-lg-12">
            <form action="{{ url('/account/view-statement') }}">
                <div class="mb-3">
                    <label for="date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="date" aria-describedby="date">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="date" aria-describedby="date">
                </div>
                 <button type="submit" class="btn btn-primary">View Statement</button>
          </form>
        </div>
    </div>
</div>

<div class="row card col-lg-12 p-4 my-3">
        <h2>Account Statements</h2>
  
        
        @if($accountStatements->isEmpty())
            <p>No account statements available.</p>
        @else
            <table class="table w-100 table-striped">
                <thead>
                    <tr>
                        
                        @role('admin')
                        <th scope="col">
                            User(Email)
                            <p></p>
                        </th>
                        @endrole                        
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Time & Date</th>
                        <th scope="col">Transaction Details</th>
                        <th scope="col">Upload</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        @role('admin')
                            <th scope="col">Action</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($accountStatements as $statement)
                        <tr>
                            @role('admin')
                            <td>
                                <span style="font-weight: bold"> {{ $statement->user->name }} </span>
                                <p style="font-style:italic">{{ $statement->user->email }}</p>
                            </td> 
                            @endrole
                            <td>{{ $statement->customer_transaction_id }}</td>
                            <td>{{ $statement->created_at }}</td>
                                <td>
                                    @if($statement->deposit)
                                        Deposit via {{ $statement->paymentMethod->title }}
                                    @elseif($statement->withdraw)
                                        Withdrawal via {{ $statement->paymentMethod->title }}
                                    @elseif($statement->internalTransfer)
                                        Internal Transfer via {{ $statement->paymentMethod->title }}
                                    @else
                                        Deposite via Daily Profit
                                    @endif
                                </td>
                                {{-- <td>{{ $statement->description ?? $statement->paymentMethod->title }}</td> --}}
                                <td>
                                    @if($statement->receipt_path)
                                    <a href="{{ asset('receipt/' . $statement->receipt_path) }}" class="badge text-bg-success text-decoration-none" target="_blank">View Receipt</a>
                                    @else
                                        <span class="badge text-bg-secondary">No Receipt</span>
                                    @endif
                                </td>

                          
                          <td>{{ number_format($statement->amount, 2) }}</td>
                          <td>
                              @switch($statement->status)
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
                              @if ($statement->status == 'pending')
                                  <form action="{{ route('account-statements.approve', $statement->id) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      <button type="submit" class="badge text-bg-success">Approve</button>
                                  </form>
                                  <form action="{{ route('account-statements.reject', $statement->id) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      <button type="submit" class="badge text-bg-danger">Reject</button>
                                  </form>
                              </td>
                              @endif
                          @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            {{-- <div class="d-flex justify-content-center">
                {{ $accountStatements->links() }}
            </div> --}}
        @endif
</div>

@endsection
@push('custom-scripts')
    
@endpush
    
  
