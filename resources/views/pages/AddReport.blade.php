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

                    @foreach($checks as $check)
                    <table class="table table-responsive">
                        <thead>
                            <th>Full Names</th>
                            <th>Water Meter</th>
                            <th>M<sup><u>3</u></sup> Consumed</th>
                            <th>Total Amount</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$check->full_names}}</td>
                                <td>{{$check->water_meter}}</td>
                                <td>{{$check->m}}</td>
                                <td>{{$check->amount}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                    
                </div>
                @foreach($checks as $check)
                <form method="POST" action="{{url('/report')}}">
                    {{csrf_field()}}

                    <div class="form-group row">
                            <label for="wmeter" class="col-sm-4 col-form-label text-md-right">Water Meter:</label>

                            <div class="col-md-6">
                                <input id="wmeter" type="text" class="form-control {{ $errors->has('wmeter') ? ' is-invalid' : '' }}" value="{{ $check->water_meter }}" name="wmeter" required autofocus >
                                 @if ($errors->has('wmeter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wmeter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                <div class="form-group row">
                            <label for="indexno" class="col-sm-4 col-form-label text-md-right">New Index N<sup><u>o</u></sup>:</label>

                            <div class="col-md-6">
                                <input id="indexno" type="text" class="form-control {{ $errors->has('indexno') ? ' is-invalid' : '' }}" value="{{ old('indexno') }}" name="indexno" required autofocus>
                                @if ($errors->has('indexno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('indexno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Count
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
