<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Kpi;
use App\Models\Position;
use App\Models\PositionKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KpiController extends Controller{

public function index(Request $request){
$manager_id= Employee::query()->where('user_id', Auth::id())->value('id');
$employees = Employee::where('manager_id',$manager_id)->get();
$position_ids =$employees->pluck('position_id')->unique();
$positions = Position::whereIn('id',$position_ids )->where('type',' KPIs & Competencies')->pluck('name_en', 'id');
return view('manager.kpis.index',compact('positions'));
}



    public function getKpis(Request $request)
    {
        $authUser=Auth::id();
        $positionKPIs = PositionKPI::where('position_id', $request->id)
            ->with('KPIs')
            ->groupBy('kpi_id','position_id')
            ->get()
            ->map(function ($pk) use ($authUser) {
            if ($pk->created_by != $authUser) {
                $pk->target = null;
                $pk->weight = null;
        }
        return $pk;
    });

        $html = view('manager.kpis.view', compact('positionKPIs','authUser'))->render();

        return response()->json(['html' => $html]);
    }

    public function storePositionKpi(Request $request){

       $validated = $request->validate([
    'kpi_id.*' => 'required|exists:kpis,id',
    'position_id.*' => 'required|exists:positions,id',
    'target.*' => 'required|numeric',
    'weight.*' => 'required|numeric',
]);

for ($i = 0; $i < count($validated['kpi_id']); $i++) {
    // Skip incomplete rows
    if (
        !isset($validated['kpi_id'][$i]) ||
        !isset($validated['position_id'][$i]) ||
        !isset($validated['target'][$i]) ||
        !isset($validated['weight'][$i])
    ) {
        continue;
    }

    $positionId = $validated['position_id'][$i];
    $kpiId = $validated['kpi_id'][$i];

    $existingKpi = PositionKPI::where('position_id', $positionId)
        ->where('kpi_id', $kpiId)
        ->where('created_by', Auth::id())
        ->first();

    if ($existingKpi) {
        $existingKpi->update([
            'target' => $validated['target'][$i],
            'weight' => $validated['weight'][$i],
            'updated_by' => Auth::id(),
        ]);
    } else {
        PositionKPI::create([
            'position_id' => $positionId,
            'kpi_id' => $kpiId,
            'target' => $validated['target'][$i],
            'weight' => $validated['weight'][$i],
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
    }
}

return redirect()->route('kpis')->with('success', 'KPIs saved successfully!');

    }
}   