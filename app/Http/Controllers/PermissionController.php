<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use Yajra\DataTables\DataTables;
use function Symfony\Component\Console\Helper\getRowColumns;

class PermissionController extends Controller
{
    public function index()
    {
        $group_names = PermissionGroup::get();
        return view('roles&permissions.permissions.index', compact('group_names'));
    }

    public function getAll(Request $request)
    {
        $permissions = Permission::with('creator.employee', 'group')->get();
//dd($permissions);
        return DataTables::of($permissions)
            ->addIndexColumn()
            ->editColumn('Permission', fn($permissions) => $permissions->name)
            ->editColumn('Permission_Group', fn($permissions) => $permissions->group->name ?? '-')
            ->editColumn('Created_By', fn($permissions) => optional($permissions->creator->employee)->name_en ?? '—')
            ->make('true');
    }

    public function create(Request $request)
    {
//dd($request);
        Permission::create([
            'name' => $request->name,
            'created_by' => Auth::id(),
            'permission_group_id' => $request->group_id,
        ]);
        toast('success', 'Permission is created successfully');
        return back();
    }

    public function getPermission($id)
    {
        $permission = Permission::where('id', $id)->with(['creator.employee', 'group'])->first();
        $group_names = PermissionGroup::get();
//        dd($permission);
        return view('roles&permissions.permissions.show', compact('permission', 'group_names'));
    }

    public function update(Request $request)
    {
//      dd($request);
        $user = Auth::id();
        $permission = Permission::where('id', $request->id)->with('creator')->first();
//      dd($request,$permission);

        if ($permission->creator->id == $user) {
//            dd('hi');
            $permission->update([
                'name' => $request->name,
                'updated_by' => $user,
                'permission_group_id' => $request->group_id,

            ]);
        } else {
            toast('error', 'You do not have permission to edit this permission');
            return back();
        }

        toast('success', 'Permission is updated successfully');
        return redirect()->route('get_permissions');
    }

  public function destroy($id)
  {
//      dd($id);

      $permission = Permission::where('id',$id)->first();
      $roles = Role::get();
//      dd($id,$permission,$roles);
      $count=0;
      foreach($roles as $role){
          if($role->hasPermissionTo($permission->name)){
              $count++;
          }
      }
      if($count>0){
          toast('error','Sorry Can Not Delete This Permission');
          return back();
      }
      $permission->where('id',$id)->delete();
      toast('success','Permission is deleted successfully');
      return redirect()->route('get_permissions');
  }

}
