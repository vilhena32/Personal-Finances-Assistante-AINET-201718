@extends('layouts.app') 
 
@section('content') 
<div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card"> 
                <div class="card-header">{{ __('Update Profile') }}</div> 
                <div class="card-body"> 
                    <form method="POST" action="{{ route('home') }}"> 
                        @csrf 
                        <div class="form-group row"> 
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label> 
 
                            <div class="col-md-6"> 
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus> 
 
                                @if ($errors->has('email')) 
                                <span class="invalid-feedback"> 
                                    <strong>{{ $errors->first('email') }}</strong> 
                                </span> 
                                @endif 
                            </div> 
                        </div> 
 
                        <div class="form-group row"> 
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> 
 
                            <div class="col-md-6"> 
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus> 
 
                                @if ($errors->has('email')) 
                                <span class="invalid-feedback"> 
                                    <strong>{{ $errors->first('email') }}</strong> 
                                </span> 
                                @endif 
                            </div> 
                        </div> 
 
                        <div class="form-group row"> 
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label> 
 
                            <div class="col-md-6"> 
                                <input id="phone" type="number" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required> 
 
                                @if ($errors->has('password')) 
                                <span class="invalid-feedback"> 
                                    <strong>{{ $errors->first('password') }}</strong> 
                                </span> 
                                @endif 
                            </div> 
                        </div> 
                        <div class="form-group row"> 
                            <label for="profile_photo" class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label> 
 
                            <div class="col-md-6"> 
                                <input id="profile_photo" type="file" class="form-control{{ $errors->has('profile_photo') ? ' is-invalid' : '' }}" name="profile_photo"> 
 
                                @if ($errors->has('profile_photo')) 
                                    <span class="invalid-feedback"> 
                                        <strong>{{ $errors->first('profile_photo') }}</strong> 
                                    </span> 
                                @endif 
                            </div> 
                        </div>                         
                        <div class="form-group row mb-0"> 
                            <div class="col-md-8 offset-md-4"> 
                                <button type="submit" class="btn btn-primary"> 
                                    {{ __('Save Changes') }} 
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