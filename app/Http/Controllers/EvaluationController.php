<?php


namespace App\Http\Controllers;


use App\Models\Competency;
use App\Models\Employee;
use App\Models\employeeCompetencyEvaluation;
use App\Models\employeeKpiEvaluation;
use App\Models\Evaluation;
use App\Models\PositionKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $employee = Employee::with(['position', 'compEvaluation'])->where('id', $request->id)->first();
//        dd($employee);

        if ($employee->position->type === " KPIs & Competencies") {
            $data['position_kpis'] = PositionKPI::where('position_id', $employee->position->id)
                ->whereNotNull('target')
                ->where('created_by', Auth::id())
                ->with('KPIs')
                ->get();
//            $data['competencies'] = Competency::where('department_id', $employee->department_id)->get();
            $data['competencies'] = Competency::with(['evaluation' => function ($query) use ($employee) {
                $query->where('employee_id', $employee->id);
            }])->where('department_id', $employee->department_id)->get();

            $data['compEvaluation'] = $employee->compEvaluation ;
            dd($data['competencies']);

            $html = view('manager.evaluation.emp_eval', [
                'position_kpis' => $data['position_kpis'],
                'competencies' => $data['competencies'],
            ])->render();


            return response()->json(['html' => $html]);

        }

    }

    public function storeEmpEval(Request $request)
    {
//dd($request);
        try {
            DB::beginTransaction();
            if($request['kpis']){
                for ($i = 0; $i < count($request['kpis']); $i++) {
                    if (
                        !isset($request['kpis'][$i]) ||
                        !isset($request['score'][$i]) ||
                        !isset($request['weighted_score'][$i])
                    ) {
                        continue;
                    }
                    $kpiId = $request['kpis'][$i];
                    EmployeeKpiEvaluation::updateOrCreate(
                        [
                            'employee_id' => $request->employee_id,
                            'kpi_id' => $kpiId,
                        ],
                        [
                            'score' => $request['score'][$i],
                            'weighted_score' => $request['weighted_score'][$i],
                            'is_finalized' => $request->action == "final_submit" ? '1' : '0',
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                        ]
                    );

                }
            }


            for ($i = 0; $i < count($request['competency_id']); $i++) {
                $compID=$request->competency_id[$i];
                if (
                    !isset($request['competency_id'][$i]) ||
                    !isset($request['compScore'][$compID])
                ) {
                    continue;
                }

                EmployeeCompetencyEvaluation::updateOrCreate(
                    [
                        'employee_id' => $request->employee_id,
                        'competency_id' => $request->competency_id[$i],
                    ],
                    [
                        'score' => $request->compScore[$compID],
                        'is_finalized' => $request->action == "final_submit" ? '1' : '0',
                        'created_by' => Auth::id(),
                        'updated_by' => Auth::id(),
                    ]
                );


            }

            if ($request->action == "final_submit") {

                $exists = Evaluation::where('employee_id', $request->employee_id)
                    ->where('position_id', $request->position_id)
                    ->first();

                $kpi_score = $request->totalKpiScore;
                $total_kpis_score = ($kpi_score * 70) / 100;
                $competencies_score = $request->totalCompScore;
                $total_competencies_score = ($competencies_score * 30) / 100;
                $total = $total_kpis_score + $total_competencies_score;

                $exists->update([
                    'kpis_score' => $kpi_score,
                    'competencies_score' => $competencies_score,
                    'total_score' => $total,
                    'updated_by' => Auth::id(),

                ]);
            }

            DB::commit();
            return redirect()->route('evaluate')->with('success', 'Data saved successfully!');
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            throw $ex;
        }
    }
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
