@extends('layouts.app')
<title>Personal Finances App</title>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store.account') }}" class="form-group">
                        @csrf

                        <div class="form-group row">
                            <label for="account_type_id" class="col-md-4 col-form-label text-md-right"> {{ __('Account Type') }} </label>

                            <div class="col-md-6">
                                <select id="account_type_id" class="form-control {{ $errors->has('account_type_id') ? ' is-invalid' : '' }}" name="account_type_id" required>
                                    <option value="">------Select------</option>                                    
                                    <option value="1">Bank Account</option>
                                    <option value="2">Pocket Money</option>
                                    <option value="3">Paypal Account</option>
                                    <option value="4">Credit Card</option>
                                    <option value="5">Meal Card</option>
                                </select> 

                                @if ($errors->has('code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('account_type_id') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right"> {{ __('Creation Date') }} </label>
                            
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">

                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_balance" class="col-md-4 col-form-label text-md-right">{{ __('Start Balance') }}</label>

                            <div class="col-md-6">
                                <input id="start_balance" type="number" step="0.05" class="form-control {{ $errors->has('start_balance') ? ' is-invalid' : '' }}" name="start_balance" required>

                                @if ($errors->has('start_balance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_balance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Account Code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" required>

                                @if ($errors->has('code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
