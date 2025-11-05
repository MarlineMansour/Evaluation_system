@extends('layout.master')
@section('title','My Evaluation')
@section('content')
    <div class="card container">
        <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                        <tr>

                            <th>Position</th>
                            <th>Department</th>
                            <th>Manager</th>
                            <th>Kpi Score <span> %</span></th>
                            <th>Competency Score <span> %</span></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if($employeeEvaluation->finalEvaluation($employeeEvaluation->position->id)->is_finalized == 1)
                            <tr>

                                <td>{{ $employeeEvaluation->position->name_en??'-' }}</td>
                                <td>{{$employeeEvaluation->department->name_en ?? '-'}}</td>
                                <td>{{$employeeEvaluation->manager->name_en ?? '-'}}</td>
                                <td>{{$employeeEvaluation->finalEvaluation($employeeEvaluation->position->id)->kpis_score ?? '-'}}</td>
                                <td>{{$employeeEvaluation->finalEvaluation($employeeEvaluation->position->id)->competencies_score ?? '-'}}</td>

                            </tr>
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No Evaluation is been assigned yet</td>
                            </tr>

                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


@endsection
