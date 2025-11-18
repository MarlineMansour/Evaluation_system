<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PermissionGroupController extends Controller
{
    public function index(){
        return view('roles&permissions.permissions.permission_group');
    }

    public function getAll()
    {
      $permission_groups =  PermissionGroup::with('creator.employee')->get();
        return DataTables::of($permission_groups)
            ->addIndexColumn()
            ->editColumn('name',fn($permission_groups)=>$permission_groups->name?? '-')
            ->editColumn('Created_By',fn($permission_groups)=>$permission_groups->creator->employee->name_en??'-')
            ->make(true);
    }

    public function create(Request $request){
//      dd($request);
      PermissionGroup::create([
          'name'=> $request->name,
          'created_by'=> Auth::id(),
      ]);
       toast('success','Permission Group is created successfully');
       return back();
    }
}
