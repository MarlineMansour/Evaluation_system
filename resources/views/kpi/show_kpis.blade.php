@extends('layout.master')
@section('title', 'positon Kpis')

@section('content')
    <div class="card container">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div>
                    <form action="{{route('store_position_kpi')}}" action="post">
                        @csrf
                    <div id="Kpis">
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
                            <tbody>

                            @foreach($kpis as $key=>$kpi)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$kpi->KPIs->name_en ?? '-'}}</td>
                                    <td>{{$kpi->KPIs->baseline ?? '-'}}</td>
                                    @if($kpi->is_finalized==1)
                                        <td>
                                            <input name="target[]" value="{{$kpi->target ?? ''}}"  readonly class="disabled">
                                        </td>
                                        <td>
                                            <input name="weight[]" value="{{$kpi->weight ?? '-'}}"  readonly class="disabled">
                                        </td>
                                    @else
                                        <td>
                                            <input name="target[]" min="0" maxlength="3" value="{{$kpi->target ?? ''}}" required>
                                        </td>
                                        <td>
                                            <input name="weight[]"  class="weight" min="0" maxlength="3" value="{{$kpi->weight ?? '-'}}" required>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row justify-content-end m-4">
                            <div class=" m-2 ">
                                <button type="submit" name="action" {{$allFinalized==true?'disabled':''}} value="submit_later" id="submit_later" class="btn btn-outline-dark"> Submit For Later</button>
                            </div>

                            <div class=" m-2">
                                <button type="submit"  name="action" {{$allFinalized==true?'disabled':''}} value="final_submit" id="final_submit" class="btn btn-outline-dark">Final Submit</button>
                            </div>
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

        });
    </script>
    @endsection
