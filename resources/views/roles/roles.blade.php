<title>{{ $title }}</title>
@extends('component.master')
@section('header')
@endsection
@section('content')
    <div class="container">
        <h3>All Roles List</h3>
        <div class="form-group">

            <a class="btn btn-info btn-sm" href="{{route('role.add')}}">Add Role</a>

        </div>
        <div class="table-responsive">


            <table id="mytable" class="table table-bordred table-striped">

                <thead>

                    <th><input type="checkbox" id="checkall" /></th>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @if(count($roles))
                    @foreach($roles as $role)
                    <tr>
                        <td><input type="checkbox" class="checkthis" name="check[]" value="{{$role->id}}"/></td>
                        <td>{{$role->name}}</td>
                        <td>

                            <a href="{{route('role.edit',$role->id)}}" type="button"   class="btn btn-primary btn-sm" data-title="Edit">Edit</a>

                            <a href="{{route('role.destroy',$role->id)}}" type="button"  class="btn btn-danger btn-sm" data-title="Delete" >Delete</a>

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <h3>No Data Found</h3>
                    @endif
                </tbody>

            </table>

            <div class="clearfix"></div>
        </div>
    @endsection
    @section('footer')
     <script>
        $(document).ready(function(){
        $("#mytable #checkall").click(function () {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("[data-toggle=tooltip]").tooltip();
        });
        </script>
    @endsection
