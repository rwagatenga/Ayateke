@extends('layouts.app')

@section('links')
<a class="navbar-brand" href="{{ url('/personal') }}">
    Add Personal Tap
</a>
<a class="navbar-brand" href="{{ url('/private') }}">
    Add Private Tap
</a>
<a class="navbar-brand" href="{{ url('/public') }}">
    Add Public Tap
</a>
<a class="navbar-brand" href="{{ url('/report') }}">
    Add Report
</a>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}} This is Where You have to Add Report </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('errors'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('errors') }}
                        </div>
                    @endif

                    
                    <form method="POST" action="{{url('/add')}}">
                        {{csrf_field()}}
                    <div class="form-group row">
                            <label for="wmeter" class="col-sm-4 col-form-label text-md-right">Water Meter:</label>

                            <div class="col-md-6">
                                <input id="wmeter" type="text" class="form-control {{ $errors->has('wmeter') ? ' is-invalid' : '' }}" value="{{ old('wmeter') }}" name="wmeter" required autofocus>
                                 @if ($errors->has('wmeter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wmeter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="indexno" class="col-sm-4 col-form-label text-md-right">New Index N<sup><u>o</u></sup>:</label>

                            <div class="col-md-6">
                                <input id="indexno" type="text" class="form-control {{ $errors->has('indexno') ? ' is-invalid' : '' }}" value="{{ old('indexno') }}" name="indexno" required autofocus>
                                @if ($errors->has('indexno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('indexno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">
                            <label for="m" class="col-sm-4 col-form-label text-md-right">M<sup>3</sup> Consumed:</label>

                            <div class="col-md-6">
                                <input id="m" type="text" class="form-control {{ $errors->has('m') ? ' is-invalid' : '' }}" value="{{ old('m') }}" name="m" required autofocus>
                                 @if ($errors->has('m'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('m') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sector" class="col-sm-4 col-form-label text-md-right">Amount:</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount') }}" name="amount" required autofocus>
                                 @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paid" class="col-sm-4 col-form-label text-md-right">Paid:</label>

                            <div class="col-md-6">
                                <input id="paid" type="text" class="form-control {{ $errors->has('paid') ? ' is-invalid' : '' }}" value="{{ old('paid') }}" name="paid" required autofocus>
                                 @if ($errors->has('paid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('paid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="debt" class="col-sm-4 col-form-label text-md-right">Debt:</label>

                            <div class="col-md-6">
                                <input id="debt" type="text" class="form-control {{ $errors->has('debt') ? ' is-invalid' : '' }}" value="{{ old('debt') }}" name="debt" required autofocus>
                                 @if ($errors->has('debt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('debt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Count
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
