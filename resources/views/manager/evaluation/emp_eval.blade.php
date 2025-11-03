
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
        <tr>
            <td>{{ $eval->KPIs->id }}</td>
            <td>{{ $eval->KPIs->name_en }}</td>
            <td>{{$eval->KPIs->is_linear==1 ? 'linear':'Inverted'}}</td>
            <td>{{ $eval->target }}</td>
            <td class="stored_weight">{{ $eval->weight}}</td>

            <td>
                <input type="number" name="score[]" placeholder="Enter Score" class="form-control score">
            </td>
            <td>
                <span class="weighted_score"></span>
                <input type="hidden" name="weighted_score[]" step="0.01"  class="form-control ">
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
    <strong class="text-warning">Total Score: <span id="totalKpiScore">0</span>%</strong>
</div>

<table class="table table-bordered"  width="100%" cellspacing="0">

    <thead>
    <tr>
        <th>ID</th>
        <th>Competency</th>
        <th>Need Enhancement</th>

    </tr>
    </thead>

    <tbody>
    @forelse($competencies as $comp)
        <tr>
            <td>{{ $comp->id }}</td>
            <td>{{ $comp->name_en }}</td>


            <td class="row justify-content-between " >

                <input type="radio" name="score[]" class="form-control-sm score " value ="20">
            </td>
                <label>Below Expectations
                    <input type="radio" name="score[]" class="form-control-sm score " value="40">
                </label>
                <label> Meet Expectations
                    <input type="radio" name="score[]" class="form-control-sm score " value="60">
                </label>
                <label>Above Expectations
                    <input type="radio" name="score[]" class="form-control-sm score " value="80">
                </label>
                <label>Exceed Expectations
                    <input type="radio" name="score[]" class="form-control-sm score" value="100">
                </label>
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No Competencies assigned for this department</td>
        </tr>
    @endforelse

    </tbody>
</table>
<div class="mt-3">
    <strong class="text-warning">Total Score: <span id="totalScore">0</span>%</strong>
</div>

