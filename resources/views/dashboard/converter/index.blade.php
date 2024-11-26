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
{{-- add validation error and error message --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

{{-- success message --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
<div class="row col-lg-12 gap-2 flex-nowrap">
    <div class="card col-md-6 p-4">
        <div class=" pb-3">
            <h3>From Currency</h3>
            {{-- <p>Please select date</p> --}}
        </div>
        <div class="col-lg-12">
            <form action="{{ url('/currency-exchange') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="from_currency" class="form-label">Transection Method</label>
                    <select class="form-select" id="from_currency" name="from_payment_method_id" aria-label="from_currency">
                        @foreach($paymentMethods as $paymentMethod)
                            @if (in_array($paymentMethod->slug, ['easypaisa', 'jazzcash', 'bank-transfer']))
                                <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{--  error message --}}
                    @error('from_payment_method_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3"> 
                    <label for="send_amount" class="form-label">Amount you send</label>
                    <input type="number" class="form-control" name="amount" value="0.00" id="send_amount" aria-describedby="transectionValue">
                    {{--  error message --}}
                    @error('amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>
    </div>

    <div class="card col-md-6 p-4">
        <div class=" pb-3">
            <h3>To Currency</h3>
            {{-- <p>Please select Method and Enter input</p> --}}
        </div>
        <div class="col-lg-12">
                <div class="mb-3">
                <label for="to_currency" class="form-label">Transection Method</label>
                <select class="form-select" id="to_currency" name="to_payment_method_id" aria-label="transectionmethod">
                    @foreach($paymentMethods as $paymentMethod)
                    @if (!in_array($paymentMethod->slug, ['easypaisa', 'jazzcash', 'bank-transfer']))
                        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->title }}</option>
                    @endif
                    @endforeach
                </select>
                </div>
                <div class="mb-3"> 
                    <label for="receive_amount" class="form-label"><b>Transection Detail:</b></label>
                    <div>
                        {{-- make a  ul list for detaling the fee, converted amount, you receive --}} 
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Converted Amount = <b><span id="converted_amount">0.00</span></b></li>
                            <li class="list-group-item">Conversion Fee (1%) = <b><span class="fee">0.00</span></b></li>
                            <li class="list-group-item">You Receive = <b><span id="receive_amount">0.00</span></b></li>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    
</div>
    <div class="col-12 my-4 text-center">
        <button class="btn btn-primary  w-25">Convert</button>
    </div>
</form>

<div>




<!-- Your custom script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculateConversion() {
        var sendAmount = document.getElementById('send_amount').value.replace(/,/g, '');
        var fromCurrencyId = document.getElementById('from_currency').value;
        var toCurrencyId = document.getElementById('to_currency').value;
        

        if (!sendAmount || !fromCurrencyId || !toCurrencyId) {
            return;
        }

        // Fetch sell rate for `from_currency`
        fetch(`/exchange-rate/${fromCurrencyId}`)
            .then(response => response.json())
            .then(fromData => {
                var fromSellRate = fromData.sell_rate;
                amountInPKR = sendAmount * fromSellRate;

                // Fetch buy rate for `to_currency`
                return fetch(`/exchange-rate/${toCurrencyId}`);
            })
            .then(response => response.json())
            .then(toData => {
                var toBuyRate = toData.buy_rate;
                var convertedAmount = amountInPKR * toBuyRate;
                convertedAmount = convertedAmount.toFixed(2);
                document.getElementById('converted_amount').innerHTML = convertedAmount;

                var conversionFee = document.querySelector('.fee');
                // Apply the conversion fee (1%)
                var fee = convertedAmount * 0.01;
                var finalAmount = convertedAmount - fee;
                console.log(fee)
                document.getElementById('receive_amount').innerHTML = finalAmount.toFixed(2);
                conversionFee.innerHTML = fee.toFixed(2);
            })
            .catch(error => console.error('Error:', error));
    }

    // Event listeners
    document.getElementById('from_currency').addEventListener('change', calculateConversion);
    document.getElementById('to_currency').addEventListener('change', calculateConversion);
    document.getElementById('send_amount').addEventListener('input', calculateConversion);
});

</script>
@endsection

    
  
