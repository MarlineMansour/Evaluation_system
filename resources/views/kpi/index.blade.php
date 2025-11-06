@extends('layout.master')
@section('title','All Evaluations')
@section('style')
    <style>
        #dataTable {
            border-inside:grey;
            text-align:center;
            color: black;
        }

        #dataTable thead th {
            border-inside:grey;
            font-weight: bold;
            text-align:center;
        }
        #dataTable_wrapper{
            overflow-x: hidden ;
        }

        #dataTable_paginate {
            display: flex !important;
            justify-content: center !important;
            margin-top: 10px;
        }
        #dataTable_paginate a
        {
            color:black;
        }

    </style>
@endsection
@section('content')
    <div class="card container">

        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">

                    <div id="positionKpis">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kpi</th>
                                <th>Position</th>
                                <th>Target is set</th>
                                <th>Weight is set</th>
                                <th>Manager</th>
                                <th>is_finalized</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')


    <script>
        $(document).ready(function () {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('all_kpis')}}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'Kpi', name: 'Kpi'},
                    {data: 'Position', name: 'Position'},
                    {data: 'Target is set', name: 'Target is set'},
                    {data: 'Weight is set', name: 'Weight is set'},
                    {data: 'Manager', name: 'Manager'},
                    {data: 'is_finalized', name: 'is_finalized'},

                ]
                // createdRow: function (row, data, dataIndex) {
                //     if (data.is_finalized === 'Yes') {
                //         $(row).css('background-color', '#bbf5bd');
                //     }
                // }

            });
        });
    </script>
@endsection
