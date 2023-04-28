<title>{{ $title }}</title>
@extends('component.master')
@section('header')

@endsection
@section('content')
<div class="container">
	<h3>Update Roles</h3>
    <div class="form-group">
        <a class="btn btn-info" href="{{ route('role.show') }}">Back</a>
    </div>
	<form action="{{ route('role.update',$role->id) }}" method="POST" >
		@csrf
		<div class="form-group">
			<label for="name">Name:</label>
			<input id="name" type="text" name="name" value="{{$role->name}}" class="form-control">
		</div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-3 mt-3">
            <h4>Permission: <div align='right'>Select All <input class="common_checkbox" type="checkbox" id="allcheckbox" onClick = "return allChecks()" /></div></h4>

        </div>
        <div class="form-group row">
        @foreach($permissions as $value)
        <div class="col-lg-2">
            <input type="checkbox" class="common_checkbox theClass"  value = "{{ $value->name }}" name="permissions[]" @if(!is_null($rolePermissions) && array_key_exists($value->id,$rolePermissions)) checked @endif  />&nbsp;&nbsp;{{ $value->name }}
        </div>
         @endforeach
        </div>

		<button class="btn btn-success">Update Role</button>
	</form>
</div>
@endsection
@section('footer')
<script>
    function allChecks(){
        //$('.theClass:checkbox:checked');
        if($('#allcheckbox').is(':checked'))
        {
            $('.theClass').attr('checked','checked');

        }else
        {
            $('.theClass').removeAttr('checked');
        }

    }
    </script>
@endsection
