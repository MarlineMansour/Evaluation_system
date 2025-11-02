
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

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

    <tbody>
    @forelse($Kpi_eval as $eval)
        <tr>
            <td>{{ $eval->KPIs->id }}</td>
            <td>{{ $eval->KPIs->name_en }}</td>
            <td>{{ $eval->target }}</td>



            <td>
                <input type="number" name="score[]" placeholder="Enter Score" value="{{ $eval->score}}" class="form-control">
            </td>
            <td>
                <input type="number" name="weighted_score[]" step="0.01" value="{{ $eval->weighted_score }}" class="form-control">
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No KPIs assigned for this employee</td>
        </tr>
    @endforelse

    </tbody>
</table>
<div class="mt-3">
    <strong class="text-warning">Total Score: <span id="totalScore">0</span>%</strong>
</div>

