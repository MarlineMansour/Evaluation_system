<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\Position;
use App\Models\PositionKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class KpiController extends Controller
{

    public function index(Request $request)
    {
        $manager_id = Employee::query()->where('user_id', Auth::id())->value('id');
        $employees = Employee::where('manager_id', $manager_id)->get();
        $position_ids = $employees->pluck('position_id')->unique();
        $positions = Position::whereIn('id', $position_ids)->where('type', ' KPIs & Competencies')->pluck('name_en', 'id');
        return view('manager.kpis.index', compact('positions'));
    }

    public function getKpis(Request $request)
    {
        $authUser = Auth::id();

        // 1️⃣ Get existing KPIs for this position (assigned by any user)
        $positionKpis = PositionKPI::where('position_id', $request->id)
            ->with('KPIs')
            ->get()
            ->groupBy('kpi_id');

        // 2️⃣ If the position has no KPIs, just return an empty collection
        if ($positionKpis->isEmpty()) {
            $merged = collect(); // return an empty collection to the view
        } else {
            // 3️⃣ Merge logic: show KPIs for this position
            $merged = $positionKpis->map(function ($records) use ($authUser, $request) {
                // The KPI record(s) for this position (there could be multiple users)
                $firstRecord = $records->first();

                // Check if this user has a personal record for it
                $userRecord = $records->firstWhere('created_by', $authUser);

                // Use user values if found; otherwise null
                return (object)[
                    'position_id' => $firstRecord->position_id,
                    'kpi_id' => $firstRecord->kpi_id,
                    'KPIs' => $firstRecord->KPIs,
                    'target' => $userRecord->target ?? null,
                    'weight' => $userRecord->weight ?? null,
                    'is_finalized' => $userRecord->is_finalized ?? null,

                ];
            })->values(); // reset array keys for Blade iteration
        }

        $html = view('manager.kpis.view', compact('merged', 'authUser'))->render();
        $allFinalized = $merged->every(fn($item) => $item->is_finalized);
        return response()->json(['html' => $html, 'allFinalized' => $allFinalized]);
    }

    public function storePositionKpi(Request $request)
    {

        try {

            DB::beginTransaction();
            $validated = $request->validate([
                'kpi_id.*' => 'required|exists:kpis,id',
                'position_id.*' => 'required|exists:positions,id',]);

            for ($i = 0; $i < count($validated['kpi_id']); $i++) {
                if (
                    !isset($validated['kpi_id'][$i]) ||
                    !isset($validated['position_id'][$i]) ||
                    !isset($request['target'][$i]) ||
                    !isset($request['weight'][$i])
                ) {
                    continue;
                }

                $positionId = $validated['position_id'][$i];
                $kpiId = $validated['kpi_id'][$i];


                $existingKpi = PositionKPI::where('position_id', $positionId)
                    ->where('kpi_id', $kpiId)
                    ->where('created_by', Auth::id())
                    ->first();

                $isFinalized = $request->action === 'final_submit' ? 1 : 0;

                if ($existingKpi) {

                    $existingKpi->update([
                        'target' => $request['target'][$i],
                        'weight' => $request['weight'][$i],
                        'updated_by' => Auth::id(),
                        'is_finalized' => $isFinalized,
                    ]);

                } else {

                    PositionKPI::create([
                        'position_id' => $positionId,
                        'kpi_id' => $kpiId,
                        'target' => $request['target'][$i],
                        'weight' => $request['weight'][$i],
                        'created_by' => Auth::id(),
                        'updated_by' => Auth::id(),
                        'is_finalized' => $isFinalized,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('kpis')->with('success', 'KPIs saved successfully!');

        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            throw $ex;
        }
    }

    public function fetchKpis()
    {
        return view('kpi.index');
    }

    public function getAllKpis(Request $request)
    {

        $data = PositionKPI::with(['KPIs', 'pos', 'creator.employee'])->get();
//dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('Kpi', fn($data) => $data->KPIs->name_en ?? '-')
            ->editColumn('Position', fn($data) => $data->pos->name_en ?? '-')
            ->editColumn('Target is set', function($data){
                return $data->target
                ? '<span class="badge bg-success">Yes</span>'
                : '<span class="badge bg-danger">No</span>';


             })
            ->editColumn('Weight is set', function($data){
                return $data->weight
                    ? '<span class="badge bg-success">Yes</span>'
                    : '<span class="badge bg-danger">No</span>';
            })
            ->editColumn('Manager', fn($data) => $data->creator->employee->name_en)
            ->editColumn('is_finalized', function($data){
                return $data->is_finalized == 1
                ? '<span class="badge bg-success">Yes</span>'
                : '<span class="badge bg-danger">No</span>';
            })
            ->rawColumns(['Target is set', 'Weight is set', 'is_finalized'])
            ->make(true);

    }

}

