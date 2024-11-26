<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    @extends('dashboard.layouts.app')
    @section('main-content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Settings</h4>
                    </div>
                    <div class="card-body">
                        <form id="settingsForm" action="{{ route('settings.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="referal_profit_percentage">Referral Profit Percentage (%)</label>
                                <input type="number" class="form-control" id="referal_profit_percentage" name="referal_profit_percentage" 
                                    value="{{ $referal_profit_percentage }}" step="0.01" min="0" max="100">
                            </div>
    
                            <div class="form-group mt-3">
                                <label for="daily_profit_percentage">Daily Profit Percentage (%)</label>
                                <input type="number" class="form-control" id="daily_profit_percentage" name="daily_profit_percentage" 
                                    value="{{ $daily_profit_percentage }}" step="0.01" min="0" max="100">
                            </div>
    
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    
    