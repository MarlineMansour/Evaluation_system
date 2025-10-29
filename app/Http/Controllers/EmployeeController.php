<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    public function getEmployees(Request $request)
    {
        $user_id=Auth::id();
        if ($request->ajax()) {
            $employee_data=Employee::where('user_id',$user_id)->first();
             // as hr manager
            if($employee_data->department_id==1){
                $employees = Employee::with([
                    'manager:id,name_en',
                    'department:id,name_en',
                    'position:id,name_en'
                ])->get();
            } else{
                // as Manager
                $employees=Employee::with([
                    'position:id,name_en,type'
                ])->where('manager_id',$employee_data->id)->get();
            }
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

        return view('manager.employees');
    }


}
