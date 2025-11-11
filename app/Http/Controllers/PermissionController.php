<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use Yajra\DataTables\DataTables;
use function Symfony\Component\Console\Helper\getRowColumns;

class PermissionController extends Controller
{
  public function index()
  {
        return view('permissions.index');
  }

  public function getAll(Request $request){
    $permissions = Permission::with('creator.employee')->get();
//dd($permissions);
    return DataTables::of($permissions)
        ->addIndexColumn()
        ->editColumn('Permission',fn($permissions)=>$permissions->name)
        ->editColumn('Created_By',fn($permissions)=>optional($permissions->creator->employee)->name_en ?? '—')
        ->make('true');
  }

  public function create(Request $request)
  {

     Permission::create([
         'name'=> $request->name,
         'created_by'=>Auth::id(),
     ]);
     toast('success','Permission is created successfully');
     return back();
  }

  public function getPermission($id){
        $permission = Permission::where('id',$id)->with('creator.employee')->first();
//        dd($permission);
        return view('permissions.show',compact('permission'));
    }

//  public function edit(Request $request)
//  {
//      $permission_name=Permission::where('id',$request->id)->pluck('name')->first();
//          return  response()->json(['permission_name'=>$permission_name]);
//  }

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

  public function destroy()
  {
      Permission::with('id',)->delete();
      toast('success','Permission is deleted successfully');
      return back();
  }

}
