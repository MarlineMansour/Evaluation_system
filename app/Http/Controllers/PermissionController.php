<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
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
        return view('roles&permissions.permissions.index',compact('group_names'));
  }

  public function getAll(Request $request){
    $permissions = Permission::with('creator.employee','group')->get();
//dd($permissions);
    return DataTables::of($permissions)
        ->addIndexColumn()
        ->editColumn('Permission',fn($permissions)=>$permissions->name)
        ->editColumn('Permission_Group',fn($permissions)=>$permissions->group->name ?? '-')
        ->editColumn('Created_By',fn($permissions)=>optional($permissions->creator->employee)->name_en ?? '—')
        ->make('true');
  }

  public function create(Request $request)
  {
//dd($request);
     Permission::create([
         'name'=> $request->name,
         'created_by'=>Auth::id(),
         'permission_group_id'=>$request->group_id,
     ]);
     toast('success','Permission is created successfully');
     return back();
  }

  public function getPermission($id){
        $permission = Permission::where('id',$id)->with(['creator.employee','group'])->first();
       $group_names = PermissionGroup::get();
//        dd($permission);
        return view('roles&permissions.permissions.show',compact('permission','group_names'));
    }

  public function update(Request $request)
  {
//      dd($request);
      Permission::where('id',$request->id)->update([
          'name'=> $request->name,
          'updated_by'=>Auth::id(),

      ]);

  toast('success','Permission is updated successfully');
      return redirect()->route('get_permissions');
  }

//  public function destroy()
//  {
//      Permission::with('id',)->delete();
//      toast('success','Permission is deleted successfully');
//      return back();
//  }

}
