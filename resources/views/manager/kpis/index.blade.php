@extends('layout.master')
@section('title', ' Kpis Target and Weight')

@section('content')
    <div class="card container">

        <!-- Modal -->
        @if (session('success'))
           <script>
                toastr.success("{{ session('success') }}");
           </script>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row-cols-6">

                   <select class="positions form-control p-2">
                       <option value="" selected disabled>Choose Position</option>
                       @foreach($positions as $id => $name)
                           <option value="{{ $id }}">{{ $name }}</option>
                       @endforeach
                   </select>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form  id="kpi_form" action="{{route('store_position_kpi')}}" method="Post">
                        @csrf
                        <div id="positionKpis">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name_en</th>
                                    <th>Baseline</th>
                                    <th>Target</th>
                                    <th>Weight</th>

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
            $('.positions').on('change', function(){
                var position_id = $(this).val();
                $('#dataTable').remove();

            $.ajax({
                url:'{{route('list_kpis')}}',
                data:{
                    id: position_id,
                },
                beforeSend: function() {
                    $('#positionKpis').html('<tr><td colspan="4">Loading KPIs...</td></tr>');
                },
                success:function(response){
                    $('#positionKpis').html(response.html);
                       if(response.allFinalized){

                           $('#submit_later').prop('disabled',true).addClass('disabled');
                           $('#final_submit').prop('disabled',true).addClass('disabled');
                           $('.weight').prop('disabled',true).addClass('disabled');
                           $('.target').prop('disabled',true).addClass('disabled');
                       }
                       else{
                           $('#submit_later').prop('disabled',false).removeClass('disabled');
                           $('#final_submit').prop('disabled',false).removeClass('disabled');
                           $('.weight').prop('disabled',false).removeClass('disabled');
                           $('.target').prop('disabled',false).removeClass('disabled');
                       }
                },
                error: function(xhr) {
                    // console.error(xhr.responseText);
                    $('#kpiTableBody').html('<tr><td colspan="4" class="text-danger">Error loading KPIs</td></tr>');
                }

            });
            });
            function calculateTotalWeights(){
                let total=0;

                $('.weight').each(function() {
                    let maxAllowed = 100 - total;


                    let currentVal = parseFloat($(this).val()) || 0;


                    if (currentVal > maxAllowed) {
                        $(this).val(maxAllowed.toFixed(2));
                        total += maxAllowed;
                    } else {
                        total += currentVal;
                    }
                     $('#totalWeight').html(total.toFixed(2));
                    });

                    if (total > 100) {
                        Swal.fire({
                            title: 'Oops!',
                            text:'Total weight must not exceed 100',
                            icon:'error',
                            confirmButtonText: 'Got it!',
                            confirmButtonColor: '#d33',
                            width:400
                        });
                    }

            }


            $('#final_submit').on('click', function(e) {
                let total = 0;
                $('.weight').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });

                if (total !== 100) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Oops!',
                        text:'Total weight must be exactly 100 to submit.',
                        icon:'error',
                        confirmButtonText: 'Got it!',
                        confirmButtonColor: '#d33',
                        width:400
                    });

                }


            });

            $('body').on('input','.weight',function(){
                calculateTotalWeights();
            });

        });


    </script>
@endsection

