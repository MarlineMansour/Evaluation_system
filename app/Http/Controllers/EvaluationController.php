<?php


namespace App\Http\Controllers;


use App\Models\Competency;
use App\Models\Employee;
use App\Models\employeeKpiEvaluation;
use App\Models\Evaluation;
use App\Models\PositionKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index()
    {
        $manager_id = Employee::query()->where('user_id', Auth::id())->value('id');
        $employees = Employee::where('manager_id', $manager_id)->get();
        return view('manager.evaluation.index', compact('employees'));
    }

    public function empKpisAndComptencies(Request $request)
    {

        $employee = Employee::with('position')->where('id', $request->id)->first();

        if ($employee->position->type === " KPIs & Competencies") {
           $data['position_kpis'] = PositionKPI::where('position_id', $employee->position->id)
                ->whereNotNull('target')
                ->where('created_by', Auth::id())
                ->with('KPIs')
                ->get();
            $data['competencies'] = Competency::where('department_id',$employee->department_id)->get();

            $html = view('manager.evaluation.emp_eval', [
                'position_kpis' => $data['position_kpis'],
                'competencies'  => $data['competencies'],
            ])->render();

            return response()->json(['html' => $html]);

        }

    }

//    public function storeEmpKpiEval(Request $request){
//
//        $kpiId = $request['kpi_id'][$i];
//          EmployeeKpiEvaluation::create([
//              'employee_id'=> $request->,
//              'kpi_id'=> $kpiId,
//              'score'=> $request->score,
//              'weighted_score'=>$request->weighted_score,
//
//
//          ]);
//    }
}


//  public function addRowInEvaluation(){
//
//
//     $employees= Employee::with(['manager:id', 'position:id'])->get();
//      foreach ($employees as $employee){
//         $exist = Evaluation::where('employee_id',$employee->id)->where('position_id',$employee->position_id)->get();
//
//         if($exist){
//                 continue;
//             }else{
//             Evaluation::create([
//                 'employee_id'=> $employee->id,
//                 'position_id'=>$employee->position_id,
//                 'manager_id'=>$employee->manager_id,
//                 'created_by'=> '1',
//                 'updated_by'=> '1',
//             ]);
//         }
//
//
//      }
//
//
//
//  }
//}
