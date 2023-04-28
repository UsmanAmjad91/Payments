<title>{{ $title }}</title>
@extends('component.master')
@section('header')

@endsection
@section('content')
<div class="container">
	<h3>Add Permission</h3>
    <div class="form-group">
        <a class="btn btn-info" href="{{ route('permission.show') }}">Back</a>
    </div>
	<form action="{{ route('permission.create') }}" method="POST" >
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input id="name" type="text" name="name" class="form-control">
		</div>

		<button class="btn btn-success">Add Permission</button>
	</form>
</div>
@endsection
@section('footer')

@endsection
