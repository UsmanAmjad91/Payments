<title>{{ $title }}</title>
@extends('component.master')
@section('header')

@endsection
@section('content')
<div class="container">
	<h3>Update Permission</h3>
    <div class="form-group">
        <a class="btn btn-info" href="{{ route('permission.show') }}">Back</a>
    </div>
	<form action="{{ route('permission.update',$permission->id) }}" method="POST" >
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input id="name" type="text" name="name" value="{{$permission->name}}" class="form-control">
		</div>

		<button class="btn btn-success">Update Permission</button>
	</form>
</div>
@endsection
@section('footer')

@endsection
