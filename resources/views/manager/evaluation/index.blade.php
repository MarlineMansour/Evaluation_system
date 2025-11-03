
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
                    <h5> Evaluation</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form  id="kpi_form" action="{{route('store_emp_kpi_eval')}}" method=post">
                        @csrf
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

                        <div class="row justify-content-end m-4">
                            <div class=" m-2 ">
                                <button type="submit" name="action"  value="submit_later" id="submit_later" class="btn btn-outline-dark"> Submit For Later</button>
                            </div>

                            <div class=" m-2">
                                <button type="submit"  name="action" value="final_submit" id="final_submit" class="btn btn-outline-dark">Final Submit</button>
                            </div>

                        </div>
                    </form>
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
               // console.log(employee_id);
                $('#dataTable').remove();

               $.ajax({
                   url:'{{route('list_emp_kpi')}}',
                   method:'post',
                   data:{
                       _token:'{{csrf_token()}}',
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

            $('body').on('input','.score', function(){
                let row = $(this).closest('tr');
                // console.log(row.find('.stored_weight').text());
                let weight = parseFloat(row.find('.stored_weight').text()) || 0;
                let score = parseFloat($(this).val()) || 0;
                // console.log(score);
                let weighted_score = ((score * weight)/100).toFixed(2);
                row.find('.weighted_score').html(weighted_score);
                let total = 0;
                $('.score').each(function() {
                    total += parseFloat($(this).val()) || 0;
                    console.log()
                    $('#totalKpiScore').html(total.toFixed(2));
                });
            });

        });


    </script>



@endsection

