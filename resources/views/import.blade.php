<title>{{ $title }}</title>
@extends('component.master')
@section('header')

@endsection
@section('content')
<div class="container">
	<h3>Import Export CSV And EXCEL File</h3>
    <div class="form-group">
        @can('export')
        <a class="btn btn-info" href="{{ route('export') }}">Export File</a>
        @endcan
    </div>
	<form action="{{ route('import') }}" method="POST" name="importform"
	  enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="file">File:</label>
			<input id="file" type="file" name="file" class="form-control">
		</div>

		<button class="btn btn-success">Import File</button>
	</form>
</div>
@endsection
@section('footer')

@endsection
