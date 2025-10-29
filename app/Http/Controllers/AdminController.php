<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Kpi;
use App\Models\PositionKPI;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function getEmployees(Request $request)
    {
        if ($request->ajax()) {

            $employees = Employee::with([
                'manager:id,name_en',
                'department:id,name_en',
                'position:id,name_en'
            ])->get();
//            dd($employees);

            return DataTables::of($employees)
                ->addIndexColumn()
                ->editColumn('position', fn($emp) => optional($emp->position)->name_en ?? '-')
                ->editColumn('department', fn($emp) => optional($emp->department)->name_en ?? '-')
                ->editColumn('manager', fn($emp) => optional($emp->manager)->name_en ?? '-')
                ->addColumn('actions', fn($emp) => '
            <button data-bs-toggle="modal" data-bs-target="#Modal2" data_id="'.$emp->id.'" class="update">
                <i class="fa-solid fa-pen"></i>
            </button>
            <button class="delete" data_id="'.$emp->id.'">
                <i class="fa-solid fa-trash"></i>
            </button>'
                )
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.employees');
    }

    public function getKPIs(Request $request){
        dd($request);
        $employee_id= Employee::query()->where('user_id', Auth::id())->value('id');
        $positions = Department::with(['hasPositions:id,name_en','hasManager'])->where('manager_id',$employee_id)->get();

        if ($request->ajax()) {

            $kpis = PositionKPI::where('position_id', $request->position_id)
                ->with('hasKPIs:id,name_en,baseline')
                ->get();


            return DataTables::of($kpis)
                ->addIndexColumn()
                ->editColumn('name_en', fn($kpis) => optional($kpis->hasKPIs)->name_en ?? '-')
                ->editColumn('baseline', fn($kpis) => optional($kpis->hasKPIs)->baseline ?? '-')
                ->editColumn('target', fn($kpis) => $kpis->target ?? '-')
                ->editColumn('weight', fn($kpis) => $kpis->weight ?? '-')
                ->addColumn('actions', fn($kpis) => '
        <button data-bs-toggle="modal" data-bs-target="#Modal2" data_id="'.$kpis->id.'" class="update">
            <i class="fa-solid fa-pen"></i>
        </button>
        <button class="delete" data_id="'.$kpis->id.'">
            <i class="fa-solid fa-trash"></i>
        </button>'
                )
                ->rawColumns(['actions'])
                ->make(true);

        }
        return view('admin.kpi',compact('positions'));
    }
}
