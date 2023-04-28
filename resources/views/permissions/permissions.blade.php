<title>{{ $title }}</title>
@extends('component.master')
@section('header')
@endsection
@section('content')
    <div class="container">
        <h3>All Permissions List</h3>
        <div class="form-group">

            <a class="btn btn-info btn-sm" href="{{route('permission.add')}}">Add Permission</a>

        </div>
        <div class="table-responsive">


            <table id="mytable" class="table table-bordred table-striped">

                <thead>

                    <th><input type="checkbox" id="checkall" /></th>
                    <th>Name</th>
                    <th>Guard Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @if(count($permissions))
                    @foreach($permissions as $permission)
                    <tr>
                        <td><input type="checkbox" class="checkthis" name="check[]" value="{{$permission->id}}"/></td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->guard_name}}</td>

                        <td>
                            @can('permission-edit')
                            <a href="{{route('permission.edit',$permission->id)}}" type="button"   class="btn btn-primary btn-sm" data-title="Edit">Edit</a>
                           @endcan

                            <a href="{{route('permission.destroy',$permission->id)}}" type="button"  class="btn btn-danger btn-sm" data-title="Delete" >Delete</a>

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
