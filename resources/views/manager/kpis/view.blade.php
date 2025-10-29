
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
    @forelse($positionKPIs as $pk)
        <tr>
            <td>{{$pk->id}}</td>
            <td>{{$pk->KPIs->name_en}}</td>
            <td>{{$pk->KPIs->baseline}}</td>
            <input hidden name="kpi_id" value="{{$pk->kpi_id}}">
            <input hidden name="position_id" value="{{$pk->position_id}}">

                <td>
                    <input type="number" placeholder="enter target" min="0" name="target"  value="{{$pk->target}}" class="form-control">
                </td>
                <td>
                    <input type="number"  step="0.01" placeholder="enter weight" min="00.00" max="100.00" name="weight" value="{{$pk->weight}}" class=" weight form-control">
                </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No KPIs found for this position.</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="mt-3">
    <strong class="text-warning">Total Weight: <span id="totalWeight">0</span>%</strong>
</div>
