@extends('layout.master')
@section('title','Employee Evaluation')
@section('content')
    <div class="card container">

        <div class="card shadow mb-4">

            <div class="card-header">
                <p class="mb-3"><a href="{{route('fetch_evaluations')}}" class="text-body"><i
                            class="fas fa-long-arrow-alt-left text-primary me-2"></i> Back</a></p>
                <hr>
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="competency_tab" href="#competencies">Competencies</a>
                        </li>
                        @if($is_white == 1)
                            <li class="nav-item">
                                <a class="nav-link" id="kpi_tab" href="#kpis">KPIS</a>
                            </li>
                        @endif

                    </ul>
                    @if($manager == $user)
                        @if((!$allKpisFinalized && $is_white == 1) || (!$allCompFinalized ))
                            <div>
                                <button class="btn btn-outline-primary" id="evaluate">Evaluate</button>
                            </div>
                        @endif
                    @endif
                </div>


            </div>
            <div class="card-body">
                <div id="body_content">
                    @if($is_white == 1)
                        <div class="d-none" id="kpis">
                            @if($kpis_eval->isEmpty())
                                <div class="text-center py-3">
                                    <h5>No evaluation yet</h5>
                                </div>
                            @else
                                <div>
                                    <table class="table table-bordered" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kpi</th>
                                            <th>Baseline</th>
                                            <th>Target</th>
                                            <th>Weight</th>
                                            <th>Score</th>
                                            <th>Weighted Score</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($kpis_eval as $index => $kpi)
                                            @php
                                                $targetandweight = $kpi->kpi->positionKpis->first();
                                            @endphp
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$kpi->kpi->name_en}}</td>
                                                <td>{{$kpi->kpi->baseline}}</td>
                                                <td>{{$targetandweight->target}}</td>
                                                <td>{{$targetandweight->weight}}</td>
                                                <td>{{$kpi?->score ?? '-'}}</td>
                                                <td>{{$kpi?->weighted_score ?? '-'}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div id="competencies">
                        @if($competencies->isEmpty())
                            <div class="text-center py-3">
                                <h5>No evaluation yet</h5>
                            </div>
                        @else
                            <div>
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Competency</th>
                                        <th>Need Improvement</th>
                                        <th>Below Expectations</th>
                                        <th>Meet Expectations</th>
                                        <th>Above Expectations</th>
                                        <th>Exceed Expectations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($competencies as $key => $comp)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$comp->competency->name_en}}</td>
                                            @foreach ([20, 40, 60, 80, 100] as $val)
                                                <td class="align-content-center">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <input type="radio"
                                                               name="compScore[{{ $comp->id }}]"
                                                               class="form-control-md compScore disabled"
                                                               value="{{ $val }}"
                                                               {{$comp->score == $val ? 'checked' : '' }} disabled
                                                               readonly>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var employee_id = @json($employee->id);
            $('#kpi_tab').on('click', function () {

                $('#kpis').removeClass('d-none');
                $('#competencies').addClass('d-none');
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
            });
            $('#competency_tab').on('click', function () {

                $('#competencies').removeClass('d-none');
                $('#kpis').addClass('d-none');
                $('.nav-link').removeClass('active');
                $(this).addClass('active');

            });
            $('#evaluate').on('click', function () {
                $.ajax({
                    url: '{{route('evaluate')}}',
                    success: function () {
                        window.location.href = "{{ route('evaluate') }}?employee_id=" + employee_id;
                    }

                });

            });

        });
    </script>
@endsection
