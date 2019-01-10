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
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    Welcome {{Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
