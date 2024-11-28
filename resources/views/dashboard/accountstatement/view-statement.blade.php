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
      <h2>Account Statements</h2>

      
      @if($accountStatements->isEmpty())
          <p>No account statements available.</p>
      @else
      <div class="table-responsive">
          <table class="table table-striped table-responsive">
              <thead>
                  <tr>
                      <th scope="col">TID</th>
                      <th scope="col">Username</th>
                      <th scope="col">Transaction</th>
                      <th scope="col">Description</th>
                      <th scope="col">Amount</th>
                      {{-- <th scope="col">Customer Name</th>
                      <th scope="col">Customer Account</th> --}}
                      <th scope="col">Customer TXID</th>
                      <th scope="col">Receipt</th>
                      <th scope="col">Status</th>
                      @role('admin')
                          <th scope="col">Action</th>
                      @endrole
                  </tr>
              </thead>
              <tbody>
                  @foreach($accountStatements as $statement)
                      <tr>
                        <td>{{ $statement->id }}</td>
                        <td>{{ $statement->user->name }}</td>
                        <td>{{ $statement->deposit ? 'Deposit' : ($statement->withdraw ? 'Withdrawal' : ($statement->internalTransfer ? 'Internal Transfer' : '  - ')) }}</td>
                        <td>{{ $statement->description ?? $statement->paymentMethod->title }}</td>
                        <td>{{ number_format($statement->amount, 2) }}</td>

                   
                        <td>{{ $statement->customer_transaction_id }}</td>
                        <td>
                            @if($statement->receipt_path)
                                <a href="{{ asset('receipt/' . $statement->receipt_path) }}" target="_blank">View Receipt</a>
                            @else
                                No Receipt
                            @endif
                        </td>
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
      </div>
          {{-- <div class="d-flex justify-content-center">
              {{ $accountStatements->links() }}
          </div> --}}
      @endif
  </div>

@endsection
@push('custom-scripts')
    
@endpush
    

