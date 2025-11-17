
@extends('layout.master')
@section('title','Role')
@section('content')
    <div class="card container">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-2">
                        <button class="btn btn-outline-info text-align-conter" id="edit">Edit</button>
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
                        <div class="my-4">
                            @foreach($group_permissions as $groupId => $groupPermissions)
                                <div class="card-body ">

                                    @if($groupId)
                                        <div class="form-check">
                                            <label class="text-primary">
                                                <input type="checkbox" disabled class="form-group " data-group="{{ $groupId }}"
                                                       {{$groupPermissions->first()->permissions?->every(fn($p) => $role->hasPermissionTo($p->name)) ? 'checked' : '' }}
                                                       name="group_id" value="{{$groupId}}">
                                                {{ $groupPermissions->first()->name ?? ' ' }}
                                            </label>
                                        </div>

                                    @endif
                                    @foreach($groupPermissions->first()->permissions as $permission)
                                        <div class="form-check">
                                            <label class="form-check-label container mx-2 ">
                                                <input type="checkbox" class="child-checkbox permission form-check-input"
                                                       data-group="{{ $groupId }}" value="{{ $permission->name}}"
                                                       @if($role->hasPermissionTo($permission->name)) checked @endif name="permissions[]" disabled>
                                                {{ $permission->name }}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                        <div class="d-flex justify-content-end">
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
                $('.permission').prop('disabled',false);
                $('.form-group ').prop('disabled',false);
                $('#submit').prop('disabled',false).removeClass('disabled');
            });

        });
    </script>
@endsection
