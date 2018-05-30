@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div> 
                <div class="card-body">

                    @if (session('error')) 
                        <div class="alert alert-danger"> 
                            {{ session('error') }} 
                        </div>
                    @endif
                    @if (session('success')) 
                        <div class="alert alert-success"> 
                          {{ session('success') }} 
                        </div> 
                    @endif

                    <form method="POST" action="{{ route('users.updatePassword') }}">
                        @method('patch')
                        @csrf
 
                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
 
                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control {{ $errors->has('old_password') ? ' has-error' : '' }}" name="old_password" required>

                                @if ($errors->has('old_password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{__('New Password') }}</label>
 
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control {{ $errors->has('new-password') ? ' has-error' : '' }}" name="password" required>
 
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="password-confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
 
                            <div class="col-md-6">
                                <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
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