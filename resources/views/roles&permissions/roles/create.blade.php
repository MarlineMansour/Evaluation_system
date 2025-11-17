@extends('layout.master')
@section('title','Create Role')
@section('content')
    <div class="card container">
        <div class="card shadow mb-4">
            <form action="{{route('create_role')}}" method="post">
                @csrf
                <div class="card-header py-3">
                    <div class="row-cols-6">

                        <select class=" form-control p-2" required name="role_id">
                            <option value="" selected disabled>Choose Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="Card">

                        @foreach($group_permissions as $groupId => $groupPermissions)
                            <div class="card-body ">

                                @if($groupId)
                                    <div class="form-check">
                                        <label class="text-primary">
                                            <input type="checkbox" class="form-group " data-group="{{ $groupId }}" name="group_id" value="{{$groupId}}">
                                            {{ $groupPermissions->first()->name ?? ' ' }}
                                        </label>
                                    </div>

                                @endif
                                @foreach($groupPermissions->first()->permissions as $permission)
                                    <div class="form-check">
                                        <label class="form-check-label container mx-2 ">
                                            <input type="checkbox" class="child-checkbox permission form-check-input"
                                                   data-group="{{ $groupId }}" value="{{ $permission->name}}" name="permissions[]">
                                            {{ $permission->name }}
                                        </label>
                                    </div>

                                @endforeach
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-primary">Save</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function () {
            $('.form-group').on('change', function () {
                let group_id = $(this).data('group');
                $('.permission[data-group="' + group_id + '"]').prop('checked', $(this).is(':checked'));

            });
        });
    </script>
@endsection
