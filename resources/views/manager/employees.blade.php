@extends('layout.master')
@section('title', ' employees')

@section('content')
    <div class="card container">

        <!-- Modal -->

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name_en</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Manager</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal hide" id="Modal_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                    <button type="button" class="btn-close closeModal2" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body" id="update_model_book" >

                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')


    <script>
        $(document).ready(function(){

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax:'{{route('employees')}}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false,searchable:false },
                    { data: 'name_en', name: 'name_en' },
                    { data: 'position', name: 'position' },
                    { data: 'department', name: 'department' },
                    { data: 'manager', name: 'manager' },
                    { data: 'actions', name: 'actions' },
                ]

            });
        });
    </script>
@endsection
