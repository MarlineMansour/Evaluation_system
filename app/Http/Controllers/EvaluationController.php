<?php


namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\employeeKpiEvaluation;
use App\Models\PositionKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
  public function index(){
      $manager_id= Employee::query()->where('user_id', Auth::id())->value('id');
      $employees = Employee::where('manager_id',$manager_id)->get();
      return view('manager.evaluation.index',compact('employees'));
  }

  public function empKpis(Request $request){

     $employee = Employee::with('position')->findOrFail($request->id);

     if($employee->position->type == "KPIs & Competencies"){

       $position_kpis = PositionKPI::where('position_id', $employee->position->id)
           ->whereNotNull('target')
           ->with('KPIs:id,name_en')
           ->get();

       $Kpi_eval=employeeKpiEvaluation::where('kpi_id',$position_kpis->KPIs->id)->get();



     }
  }

}
