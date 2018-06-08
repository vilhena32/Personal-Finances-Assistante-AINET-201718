@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Document') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{-- route('store.doc') --}}" enctype="multipart/form-data">
                        @csrf

                
                        <div class="form-group row">
                            <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Document') }}</label>

                            <div class="col-md-6">
                                <input id="document" type="file" class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}" name="document">

                                @if ($errors->has('document'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
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
