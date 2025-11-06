@extends('layout.master')
@section('title','All Kpis')
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
                                <th><span>Employee <br> (Position)</span></th>
                                <th>Target_is_set</th>
                                <th>KPis_Score</th>
                                <th>Competencies_Score</th>
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
                ajax: '{{route('all_evaluations')}}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'Employee', name: 'Employee'},
                    {data: 'Target_is_set', name: 'Target_is_set'},
                    {data: 'KPis Score', name: 'KPis Score'},
                    {data: 'Competencies_Score', name: 'Competencies_Score'},
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
