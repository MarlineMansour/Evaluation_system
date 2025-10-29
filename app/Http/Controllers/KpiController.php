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
  dd($request);
    PositionKPI::create($request);

    return redirect()->route('list_kpis');
    }

}

