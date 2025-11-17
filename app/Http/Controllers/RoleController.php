<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
  public function index()
  {
      return view('roles&permissions.roles.index');
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
      $role=Role::findOrFail($request->role_id);
//      dd($role);
      foreach($request->permissions as $perName) {
          $role->givePermissionTo($perName);
      }
      toast('success','Role is created successfully');
      return redirect()->route('get_roles');
  }

  public function get($id){
     $role= Role::where('id',$id)->with('creator.employee')->first();
//     dd($role);
      $group_permissions= PermissionGroup::with('permissions')->get()->groupBy('id');

     return view('roles&permissions.roles.show',compact('role','group_permissions'));
  }


  public function update(Request $request){
//      dd($request);

      $role=Role::findOrFail($request->id);
      Role::where('id',$request->id)->update([
          'name'=> $request->name,
          'updated_by'=>Auth::id(),
      ]);
      $role->syncPermissions($request->permissions);

      toast('success','Role is updated successfully');
      return redirect()->route('get_roles');
  }

  public function showAll()
  {
      $roles = Role::get();
//      $permissions= Permission::with('group')->get()->groupBy('permission_group_id');
      $group_permissions= PermissionGroup::with('permissions')->get()->groupBy('id');
//      dd($group_permissions);
      return view('roles&permissions.roles.create',compact('roles','group_permissions'));
  }
  public function destroy(){

  }

  public function assignTo(){

  }

}
