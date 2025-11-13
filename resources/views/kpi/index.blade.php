@extends('layout.master')
@section('title','All Kpis')
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

            <div class="card-body">
                <div class="table-responsive">

                    <div id="positionKpis">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Position</th>
                                <th>Target is set</th>
                                <th>Weight is set</th>
                                <th>Manager</th>
                                <th>Submitted</th>

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
                searching: false,
                processing: true,
                serverSide: true,
                ajax: '{{route('all_kpis')}}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'Position', name: 'Position'},
                    {data: 'Target is set', name: 'Target is set'},
                    {data: 'Weight is set', name: 'Weight is set'},
                    {data: 'Manager', name: 'Manager'},
                    {data: 'Submitted', name: 'Submitted'},

                ],
                rowCallback: function (row, data) {
                    $(row).attr('data_id', data.id);
                    $(row).off('click').on('click', function () {
                        $('#dataTable tbody tr').removeClass('active-row');
                        $(this).addClass('active-row');
                    });
                    $(row).dblclick(function () {
                        var positionId = $(this).data('position');
                        var managerId = $(this).data('manager');
                        var url = '{{ route("show_kpi") }}' + '?position=' + positionId + '&manager=' + managerId;
                        window.location.href = url;

                    });
                }
                // createdRow: function (row, data, dataIndex) {
                //     if (data.is_finalized === 'Yes') {
                //         $(row).css('background-color', '#bbf5bd');
                //     }
                // }

            });
        });
    </script>
@endsection
