
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <thead>
    <tr>
        <th>ID</th>
        <th>Kpi</th>
        <th>type</th>
        <th>Target</th>
        <th>Weight</th>
        <th>Score</th>
        <th>Weighted Score</th>
    </tr>
    </thead>

    <tbody>
    @forelse($position_kpis as $eval)
        @php
            $evaluation = $eval->KPIs->evaluation->first(); // get the first evaluation for this employee
        @endphp
        <tr>
            <td>{{ $eval->KPIs->id }}</td>
            <td>{{ $eval->KPIs->name_en }}</td>
            <td class="type">{{$eval->KPIs->is_linear==1 ? 'linear':'Inverted'}}</td>
            <td class="target">{{ $eval->target }}</td>
            <td class="stored_weight">{{ $eval->weight}}</td>
            <input type="hidden" name="kpis[]" value="{{ $eval->KPIs->id }}">
            <input type="hidden" name="position_id" value="{{$eval->position_id}}">

            <td>
                <input type="number" name="score[]" placeholder="Enter Score" class="form-control score"  min="0" value="{{$evaluation->score ?? 0 }}">
            </td>
            <td>
                <span class="weightedScore">{{$evaluation->weighted_score ?? 0}}</span>
                <input type="hidden" name="weighted_score[]" step="0.01"  class="form-control weightedScore " value="{{$evaluation->weighted_score ?? 0}}">
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No KPIs assigned for this position</td>
        </tr>
    @endforelse

    </tbody>
</table>
<div class="mt-3">
    <strong class="text-warning">Total Score: <span id="totalKpiScore">{{$final->kpis_score ?? 0}}</span>%</strong>
    <input type="hidden" name="totalKpiScore" class="totalKpiScore" value="{{$final->kpis_score ?? ''}}" >

</div>

<table class="table table-bordered"  width="100%" cellspacing="0">

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
    @forelse($competencies as $comp)
        @php
            $score = optional($comp->evaluation->first())->score;
        @endphp
        <tr>
            <td>{{ $comp->id }}</td>
            <td>{{ $comp->name_en }}</td>
            <input type="hidden" name="competency_id[]" value="{{ $comp->id }}">
            <input type="hidden" name="emp_posiyion_id" value="{{$employee->position_id}}">
            @foreach ([20, 40, 60, 80, 100] as $val)
                <td class="align-content-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="radio"
                               name="compScore[{{ $comp->id }}]"
                               class="form-control-md compScore"
                               value="{{ $val }}"
                            {{ $score == $val ? 'checked' : '' }}>
                    </div>
                </td>
            @endforeach

{{--            <td class="align-content-center">--}}
{{--                <div class="d-flex justify-content-center align-items-center">--}}
{{--                    <input type="radio" name="compScore[{{$comp->id}}]" class="form-control-md compScore" value ="20" {{$comp->evaluation->first()->score == 20 ? 'checked': ''}}>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--            <td class="align-content-center">--}}
{{--                <div class="d-flex justify-content-center align-items-center">--}}
{{--                     <input type="radio" name="compScore[{{$comp->id}}]" class="form-control-md compScore" value="40" {{$comp->evaluation->first()->score == 40 ? 'checked': ''}}>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--            <td class="align-content-center">--}}
{{--                <div class="d-flex justify-content-center align-items-center">--}}
{{--                       <input type="radio" name="compScore[{{$comp->id}}]" class="form-control-md compScore" value="60" {{$comp->evaluation->first()->score == 60 ? 'checked': ''}}>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--            <td class="align-content-center">--}}
{{--                <div class="d-flex justify-content-center align-items-center">--}}
{{--                      <input type="radio" name="compScore[{{$comp->id}}]" class="form-control-md compScore" value="80" {{$comp->evaluation->first()->score == 80 ? 'checked': ''}}>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--            <td class="align-content-center">--}}
{{--                <div class="d-flex justify-content-center align-items-center">--}}
{{--                    <input type="radio" name="compScore[{{$comp->id}}]" class="form-control-md compScore" value="100" {{$comp->evaluation->first()->score == 100 ? 'checked': ''}}>--}}
{{--                </div>--}}
{{--            </td>--}}

        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No Competencies assigned for this department</td>
        </tr>
    @endforelse

    </tbody>
</table>
<div class="mt-3">
    <strong class="text-warning">Total Score: <span id="totalCompScore">{{$final->competencies_score ?? 0}}</span>%</strong>
    <input type="hidden" name="totalCompScore" class="totalCompScore" value="{{$final->competencies_score ?? ''}}">
</div>

