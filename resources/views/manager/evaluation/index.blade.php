
@extends('layout.master')
@section('title', 'evaluation')

@section('content')
    <div class="card container">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <div class="row-cols-6">

                <select class="employees form-control p-2">
                    <option value="" selected disabled>Choose Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name_en }}</option>
                    @endforeach
                </select>
            </div>
         </div>
        </div>

        <!-- Modal -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <h5>KPIs Evaluation</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
{{--                    <form  id="kpi_form" action="{{route('store_employee_kpi_evaluation')}}" method="Post">--}}
{{--                        @csrf--}}
                        <div id="employeeKpisEval">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kpi</th>
                                    <th>Target</th>
                                    <th>Weight</th>
                                    <th>Score</th>
                                    <th>Weighted Score</th>
                                </tr>
                                </thead>

                            </table>
                        </div>

                        <div>

                            <button type="submit" id="save_1" class="btn btn-outline-dark">Save</button>


                        </div>
{{--                    </form>--}}
                </div>
            </div>

        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <h5>Competencies Evaluation</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
{{--                    <form  id="kpi_form" action="{{route('store_employee_competencies_evaluation')}}" method="Post">--}}
{{--                        @csrf--}}
                        <div id="employeeCompetenciesEval">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Competency</th>
                                    <th>Score</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        <div>

                            <button type="submit" id="save_2" class="btn btn-outline-dark">Save</button>


                        </div>
{{--                    </form>--}}
                </div>
            </div>

        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                 <h5>Total Evaluation</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
{{--                    <form  id="kpi_form" action="{{route('store_employee_evaluation')}}" method="Post">--}}
{{--                        @csrf--}}
                        <div id="employeeEval">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>KPI Score</th>
                                    <th>Competency Score</th>
                                    <th>Total Score</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        <div>

                            <button type="submit" id="save_3" class="btn btn-outline-dark">Save</button>


                        </div>
{{--                    </form>--}}
                </div>
            </div>

        </div>

    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.employees').on('change', function(){
               var employee_id  = $(this).val() ;
                $('#dataTable').remove();
               $.ajax({
                   url:'{{route('list_emp_kpi')}}',
                   method: 'post',
                   data:{
                     id:  employee_id,
                   },
                   beforeSend: function() {
                       $('#employeeKpisEval').html('<tr><td colspan="4">Loading KPIs...</td></tr>');
                   },
                   success:function(response){
                       $('#employeeKpisEval').html(response.html);
                   }

               });
            });
        });
    </script>



@endsection

