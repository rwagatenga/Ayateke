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
                <div class="card-header">{{Auth::user()->name}} This is Where You have to Add Public Taps Information </div>

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

                    <form method="POST" action="{{url('/public')}}">
                        {{csrf_field()}}
                    <div class="form-group row">
                            <label for="fname" class="col-sm-4 col-form-label text-md-right">Full Names:</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control {{ $errors->has('fname') ? ' is-invalid' : '' }}" value="{{ old('fname') }}" name="fname" required autofocus>
                                 @if ($errors->has('fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notap" class="col-sm-4 col-form-label text-md-right">N<sup><u>o</u></sup> of Tap:</label>

                            <div class="col-md-6">
                                <input id="notap" type="text" class="form-control {{ $errors->has('notap') ? ' is-invalid' : '' }}" value="{{ old('notap') }}" name="notap" required autofocus>
                                @if ($errors->has('notap'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('notap') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nid" class="col-sm-4 col-form-label text-md-right">National Id:</label>

                            <div class="col-md-6">
                                <input id="nid" type="text" class="form-control {{ $errors->has('nid') ? ' is-invalid' : '' }}" value="{{ old('nid') }}" name="nid" required autofocus>
                                @if ($errors->has('nid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-sm-4 col-form-label text-md-right">Phone Number:</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control {{ $errors->has('tel') ? ' is-invalid' : '' }}" value="{{ old('tel') }}" name="tel" required autofocus>
                                 @if ($errors->has('tel'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sector" class="col-sm-4 col-form-label text-md-right">Sector:</label>

                            <div class="col-md-6">
                                <input id="sector" type="text" class="form-control {{ $errors->has('sector') ? ' is-invalid' : '' }}" value="{{ old('sector') }}" name="sector" required autofocus>
                                 @if ($errors->has('sector'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sector') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cell" class="col-sm-4 col-form-label text-md-right">Cell:</label>

                            <div class="col-md-6">
                                <input id="cell" type="text" class="form-control {{ $errors->has('cell') ? ' is-invalid' : '' }}" value="{{ old('cell') }}" name="cell" required autofocus>
                                 @if ($errors->has('cell'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cell') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="village" class="col-sm-4 col-form-label text-md-right">Village:</label>

                            <div class="col-md-6">
                                <input id="village" type="text" class="form-control {{ $errors->has('village') ? ' is-invalid' : '' }}" value="{{ old('village') }}" name="village" required autofocus>
                                 @if ($errors->has('village'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('village') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
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
