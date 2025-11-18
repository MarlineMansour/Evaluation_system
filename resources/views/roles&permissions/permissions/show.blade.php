
    @extends('layout.master')
    @section('title','Permission')
    @section('content')
        <div class="card container">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <p class="mb-3"><a href="{{route('get_permissions')}}" class="text-body"><i
                                class="fas fa-long-arrow-alt-left text-primary me-2"></i> Back</a></p>
                    <hr>
                    <div class="row">
                        <div class="col-2">
                            <button class="btn btn-outline-info" id="edit">Edit</button>
                        </div>
                        <div class="col-2">
                        <a href="{{route('delete_permission',$permission->id)}}" class="btn btn-outline-danger">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('update_permission')}}" method="post">
                        @csrf
                        <div>
                            <div id="showPermission" class="row">
                                <div class="col-6">
                                    <input hidden value="{{$permission->id}}" name="id">
                                    <label for="permission" class="text-primary">Permission</label>
                                    <input class="form-control" id="permission" readonly value="{{$permission->name}}" name="name">
                                </div>
                                <div class="col-6">
                                    <label for="creator" class="text-primary">Created By</label>
                                    <input class="form-control" id="creator" type="text" readonly value="{{$permission->creator->employee->name_en}}">
                                </div>
                            </div>
                            <div class="my-4">
                                <label class="text-primary" for="group">Permission Group </label>
                                <select class="form-select form-outline m-2" disabled id="group" name="group_id">
                                    <option value="" disabled selected>Choose Group</option>
                                    @foreach($group_names as $group_name)
                                        <option @if($permission->group?->id && $group_name->id == $permission->group->id)  selected @endif value="{{$group_name->id}}" >{{$group_name->name}}</option>
                                    @endforeach
                                </select>
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
                    $('#permission').prop('readonly',false);
                    $('#group').prop('disabled',false);
                    $('#submit').prop('disabled',false).removeClass('disabled');
                });
            });
        </script>
    @endsection
