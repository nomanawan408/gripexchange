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

<div class="card">
	<div class=" card-header"> 
		<h4 class="card-title">Invite and Earn</h4>
		<p>Share your referral link with your friends and earn rewards!<b>(Referal Commission:1%)</b></p>
		<div class="input-group d-flex gap-2">
		<input type="text" class="form-control" id="referralLink" value="{{ route('register', ['referral_code' => Auth::user()->referral_code]) }}" readonly>
		<div class="input-group-append">
			<button class="btn btn-outline-primary" onclick="copyReferralLink()">Copy Link</button>
		</div>
	</div>
	</div>
	<div class="col-lg-12 ">
	
	
	</div>
	<div class="my-4 card-header">
		<h4 class="card-title">My Referrals</h4>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Joined Date</th>
					</tr>
				</thead>
				<tbody>
					@forelse(Auth::user()->referrals as $referral)
						<tr>
							<td>{{ $referral->referred->name }}</td>
							<td>{{ $referral->referred->email }}</td>
							<td>{{ $referral->created_at->format('d M Y') }}</td>
						</tr>
					@empty
						<tr>
							<td colspan="3" class="text-center">No referrals found</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div></div>
@endsection
@push('custom-scripts')
<script>
function copyReferralLink() {
	var copyText = document.getElementById("referralLink");
	copyText.select();
	copyText.setSelectionRange(0, 99999);
	document.execCommand("copy");
	alert("Referral link copied!");
}
</script>
@endpush    
  
