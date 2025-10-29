@extends('layout.master')
@section('title', ' employees')

@section('content')
    <div class="card container">

        <!-- Modal -->

        <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row-cols-6">

                   <select class="positions">
                       @foreach($positions as $position)
                       <option value="{{$position->id}}">{{$position->name_en}}</option>
                           @endforeach
                   </select>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name_en</th>
                            <th>Baseline</th>
                            <th>Target</th>
                            <th>Weight</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
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
                ajax: '{{route('kpis')}}',
                data: function(d) {

                    d.position_id = $('.positions').val();
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'baseline', name: 'baseline'},
                    {data: 'target', name: 'target'},
                    {data: 'weight', name: 'weight'},

                ]


            });
            $('.positions').on('change', function() {
                table.ajax.reload();
            });

        });
    </script>
@endsection

