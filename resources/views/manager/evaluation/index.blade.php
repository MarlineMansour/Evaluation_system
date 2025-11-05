
@extends('layout.master')
@section('title', 'evaluation')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form  id="kpi_form" action="{{route('store_emp_eval')}}" method="post">
        @csrf
    <div class="card container">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <div class="row-cols-6">

             <select name="employee_id" class="employees form-control p-2">
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

{{--                        <input type="hidden" name="employee_id" value="{{$employee->id}}">--}}
                        <div id="employeeEval">
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

                </div>
            </div>

        </div>


    </div>
    </form>

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
                       $('#employeeEval').html('<tr><td colspan="4">Loading KPIs...</td></tr>');

                   },
                   success:function(response){
                       $('#employeeEval').html(response.html);
                       if(response.allFinalized){

                           $('#submit_later').prop('disabled',true).addClass('disabled');
                           $('#final_submit').prop('disabled',true).addClass('disabled');
                           $('.score').prop('disabled',true).addClass('disabled');
                           $('.weightedScore').prop('disabled',true).addClass('disabled');
                           $('.compScore').prop('disabled',true).addClass('disabled');
                       }
                       else{
                           $('#submit_later').prop('disabled',false).removeClass('disabled');
                           $('#final_submit').prop('disabled',false).removeClass('disabled');
                           $('.score').prop('disabled',false).removeClass('disabled');
                           $('.weightedScore').prop('disabled',false).removeClass('disabled');
                           $('.compScore').prop('disabled',false).removeClass('disabled');
                       }
                   },
                   error: function(xhr) {
                       console.error(xhr.responseText);
                       $('#employeeEval').html('<tr><td colspan="4" class="text-danger">Error loading Data</td></tr>');
                   }

               });
            });

            $('body').on('input','.score', function(){
                let row = $(this).closest('tr');
                // console.log(row.find('.stored_weight').text());
                let weight = parseFloat(row.find('.stored_weight').text()) || 0;
                let score = parseFloat($(this).val()) || 0;
                let target = parseFloat(row.find('.target').text()) ;
                let type = row.find('.type').text();
                let weighted_score =0;
                if(type == "linear")
                {
                    if(score> target)
                    {
                        score=target;
                    }
                    weighted_score = ((score * weight)/100).toFixed(2);
                }
                else{
                    if(score > target){
                        score = target ;
                    }
                    let invertedScore = target - score;
                    weighted_score = ((invertedScore * weight)/100).toFixed(2);
                }
                // console.log(score);

                row.find('.weightedScore').html(weighted_score);
                row.find('.weightedScore').val(weighted_score);
                let total = 0;
                $('.weightedScore').each(function() {
                    total += parseFloat($(this).html()) || 0;
                    console.log('kpis',total)
                    $('#totalKpiScore').html(total.toFixed(2));
                });
                $('.totalKpiScore').val(total.toFixed(2));

            });



        });

    $(document).on('change', '.compScore', function(){
        let total=0;
        let counts =0;
        $('.compScore:checked').each(function() {
            counts++;
            total += (parseInt($(this).val()) || 0);

            $('#totalCompScore').html((total.toFixed(2))/counts);
        });
        // console.log(counts,total);

        $('.totalCompScore').val((total.toFixed(2))/counts);

    });

    </script>



@endsection

