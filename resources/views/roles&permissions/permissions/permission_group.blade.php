@extends('layout.master')
@section('title', 'Permission Groups')
@section('style')
    <style>
        #dataTable {
            border-inside: grey;
            text-align: center;
            color: black;
        }

        #dataTable thead th {
            border-inside: grey;
            font-weight: bold;
            text-align: center;
        }

        #dataTable_wrapper {
            overflow-x: hidden;
        }

        #dataTable_paginate {
            display: flex !important;
            justify-content: center !important;
            margin-top: 10px;
        }

        #dataTable_paginate a {
            color: black;
        }
        /* Hover effect */
        #dataTable tbody tr:hover {
            background-color: #f3f3f3; /* light primary color */
        }

        /* Active row effect */
        #dataTable tbody tr.active-row {
            background-color: #2f83dd; /* primary color */
            color: white; /* optional for text contrast */
        }
    </style>
@endsection
@section('content')
    <div class="card container">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6 ml-2">
                        <button data-bs-toggle="modal" data-bs-target="#Modal_create" class="btn btn-outline-primary"
                                id="create">Create
                        </button>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div>
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Permission Group</th>
                                <th>Created_By</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
        <div class="modal hide" id="Modal_create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Permission Group</h5>
                        <button type="button" class="btn-close closeModel1" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body" id="create_model_role">
                        <form action="{{route('create_permission_group')}}" method="post">
                            @csrf
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" class="form-control form-control-lg" required name="name"/>
                            </div>
                            <div class="row">
                                <div  class="col-7"></div>
                                <button type="submit" class="btn btn-outline-primary col-4">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
@endsection
@section('script')

    <script>

        $(document).ready(function () {

            $('#dataTable').DataTable({
                searching:false,
                processing: true,
                serverSide: true,
                ajax: '{{route('show_permission_groups')}}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'Created_By', name: 'Created_By'},
                ],

                rowCallback: function(row, roles , index){

                    $(row).attr('data-id', roles.id);
                    $(row).off('click').on('click', function () {
                        $('#dataTable tbody tr').removeClass('active-row');
                        $(this).addClass('active-row');
                    });

                    {{--$(row).dblclick(function () {--}}
                    {{--    var data = $(this).attr('data-id');--}}
                    {{--    var url = '{{route("show_role",":id")}}';--}}
                    {{--    url = url.replace(':id', data);--}}
                    {{--    window.location.href=url;--}}

                    {{--});--}}

                }

            });

            $('#create').on('click', function () {
              $('#Modal_create').show();
            })
            $('.closeModel1').on('click', function () {
                $('#Modal_create').hide();
            });



        });


    </script>
@endsection


