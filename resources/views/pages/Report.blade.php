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
                            <th colspan="2">Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$check->full_names}}</td>
                                <td>{{$check->water_meter}}</td>
                                <td>{{$check->m}}</td>
                                <td>{{$check->amount}}</td>
                                <td><button><a href="{{url('confirm')}}">Confirm</a></button></td>
                                <td><button><a href="{{url('cancel/'.$check->id)}}">Cancel</a></button></td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection