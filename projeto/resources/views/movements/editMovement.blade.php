@extends('layouts.app')
<title>Personal Finances App</title>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Movement') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update.movements',$movement->id)  }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Type/Cateogry') }}</label>

                            <div class="col-md-6">
                                <select class="textWidth form-control" name="type/category" id="type/category" type="text">
                                    <optgroup label="Expense" id="Expense" name="Expense">
                                        
                                        <option>Food</option>
                                        <option>Clothes</option>
                                        <option>Services</option>
                                        <option>Electricity</option>
                                        <option>Phone</option>
                                        <option>Fuel</option>
                                        <option>Mortgage Payment</option>

                                    </optgroup> 
                                    <optgroup label="Revenue" name="Revenue" id="Revenue">
                                        <option>Salary</option>
                                        <option>Bonus</option>
                                        <option>Royalties</option>
                                        <option>Interests</option>
                                        <option>Gifts</option>
                                        <option>Dividends</option>
                                        <option>Product Sales</option>


                                    </optgroup>
                                </select>


                            </div>
                        </div>

                       

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" required>

                                @if ($errors->has('date'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Value') }}</label>

                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value="{{ old('value') }}">

                                @if ($errors->has('value'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                               <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" >

                               
                            </span>
                            
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Edit Movement') }}
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
