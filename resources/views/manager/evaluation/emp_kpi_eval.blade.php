
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
    @forelse()
        <tr>
            <td>{{  }}</td>
            <td>{{  }}</td>
            <td>{{  }}</td>

            <input type="hidden" name="kpi_id[]" value="{{  }}">
            <input type="hidden" name="position_id[]" value="{{  }}">

            <td>
                <input type="number" name="target[]" placeholder="Enter target" value="{{  }}" class="form-control">
            </td>
            <td>
                <input type="number" name="weight[]" step="0.01" placeholder="Enter weight" value="{{  }}" class="form-control weight">
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

