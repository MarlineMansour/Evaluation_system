
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name_en</th>
        <th>Baseline</th>
        <th>Target</th>
        <th>Weight</th>

    </tr>
    </thead>
    <tbody >
    @forelse($merged as $pk)
        <tr>
            <td>{{ $pk->kpi_id }}</td>
            <td>{{ $pk->KPIs->name_en ?? '—' }}</td>
            <td>{{ $pk->KPIs->baseline ?? '—' }}</td>

            <input type="hidden" name="kpi_id[]" value="{{ $pk->kpi_id }}">
            <input type="hidden" name="position_id[]" value="{{ $pk->position_id }}">

            <td>
                <input type="number" name="target[]" placeholder="Enter target" value="{{ $pk->target }}" class="form-control">
            </td>
            <td>
                <input type="number" name="weight[]" step="0.01" placeholder="Enter weight" value="{{ $pk->weight }}" class="form-control weight">
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No KPIs assigned to this position</td>
        </tr>
    @endforelse

    </tbody>
</table>
<div class="mt-3">
    <strong class="text-warning">Total Weight: <span id="totalWeight">0</span>%</strong>
</div>
