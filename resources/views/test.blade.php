@extends('layouts.app')

@section('content')
<form method="POST" action="{{url('/coin')}}">
	{{csrf_field()}}
	<input type="text" name="name"><br>
	<input type="text" name="price"><br>
	<input type="submit" name="submit" value="Submit">
</form>
@endsection