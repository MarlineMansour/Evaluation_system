<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
  public function index()
  {
      return view('roles.index');
  }
  public function getAll(Request $request){
     $roles = Role::with('creator.employee')->get();

      return DataTables::of($roles)
          ->addIndexColumn()
          ->editColumn('Role',fn($roles)=>$roles->name)
          ->editColumn('Created_By',fn($roles)=>$roles->creator->employee->name_en ?? '—')
          ->make('true');
  }

  public function create(Request $request){
//      dd($request);
      Role::create([
          'name'=> $request->name,
          'created_by'=>Auth::id(),

      ]);
      toast('success','Role is created successfully');
      return back();

  }

  public function get(Request $request){
     $role= Role::with('id',$request->id)->first();
     return view('roles.show',compact('role'));
  }


  public function update(Request $request){
      Role::where('id',$request->id)->update([
          'name'=> $request->name,
          'updated_by'=>Auth::id(),
      ]);

      toast('success','Role is updated successfully');
      return redirect()->route('get_roles');
  }

}
