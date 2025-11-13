
@extends('layout.master')
@section('title','Role')
@section('content')
    <div class="card container">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-2">
                        <button class="btn btn-outline-info" id="edit">Edit</button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-outline-danger" id="delete">Delete</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('update_role')}}" method="post">
                    @csrf
                    <div>
                        <div id="showPermission" class="row">
                            <div class="col-6">
                                <input hidden value="{{$role->id}}" name="id">
                                <label for="role" class="text-primary">Role</label>
                                <input class="form-control" id="role" readonly value="{{$role->name}}" name="name">
                            </div>
                            <div class="col-6">
                                <label for="creator" class="text-primary">Created By</label>
                                <input class="form-control" id="creator" type="text" readonly value="{{$role->creator->employee->name_en ?? '-'}}">
                            </div>

                        </div>
                        <div class="row my-4">
                            <div class="col-7"></div>
                            <button type="submit" id="submit" disabled class="btn btn-outline-primary col-3 disabled">Submit</button>
                        </div>
                    </div>
                </form>
            </div>



        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#edit').click(function(){

                $('#role').prop('readonly',false);
                $('#submit').prop('disabled',false).removeClass('disabled');
            });

        });
    </script>
@endsection
