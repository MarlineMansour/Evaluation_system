@extends('layout.master')
@section('title', ' KPIs')

@section('content')
    <div class="card container">

        <!-- Modal -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
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

                    <div>

                            <button type="submit" id="save_btn" class="btn btn-outline-dark">Save</button>


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
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    $('#kpiTableBody').html('<tr><td colspan="4" class="text-danger">Error loading KPIs</td></tr>');
                }

            });
            });
            function calculateTotalWeights(){
                let total=0;
                $('.weight').each(function() {
                    let maxAllowed = 100 - total;

                    // Get the current value
                    let currentVal = parseFloat($(this).val()) || 0;

                    // If current value exceeds maxAllowed, set it to maxAllowed
                    if (currentVal > maxAllowed) {
                        $(this).val(maxAllowed.toFixed(2));
                        total += maxAllowed;
                    } else {
                        total += currentVal;
                    }
                     $('#totalWeight').html(total.toFixed(2));
                    });

                   // if (total !== 100) {
                   //     $('#kpi_form').on('submit', function(e){
                   //         e.preventDefault();
                   //     });
                   // }

                    // Optional: alert if total exceeds 100
                    if (total > 100) {
                        alert('Total weight must not exceed 100');
                    }

            }
            // Bind submit handler once
            $('#kpi_form').on('submit', function(e) {
                let total = 0;
                $('.weight').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });

                if (total !== 100) {
                    e.preventDefault(); // stop submission
                    alert('Total weight must be exactly 100 to submit.');
                }
            });

            $('body').on('input','.weight',function(){
                calculateTotalWeights();
            });

        });
    </script>
@endsection

