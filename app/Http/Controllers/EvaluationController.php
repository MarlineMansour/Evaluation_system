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
use Yajra\DataTables\Facades\DataTables;

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

        $employee = Employee::with(['position', 'compEvaluation', 'kpiEvaluation'])->where('id', $request->id)->first();
//       dd($employee);
        $data['employee'] = $employee;
        if ($employee->position->type === " KPIs & Competencies") {
            $data['position_kpis'] = PositionKPI::where('position_id', $employee->position->id)
                ->whereNotNull('target')
                ->where('created_by', Auth::id())
                ->with(['KPIs', 'KPIs.evaluation' => function ($query) use ($employee) {
                    $query->where('employee_id', $employee->id);
                }])
                ->get();
//            $data['competencies'] = Competency::where('department_id', $employee->department_id)->get();
            $data['competencies'] = Competency::with(['evaluation' => function ($query) use ($employee) {
                $query->where('employee_id', $employee->id);
            }])->where('department_id', $employee->department_id)->get();
//            dd($data['employee']);
//            $data['compEvaluation'] = $employee->compEvaluation ;

            $allKpisFinalized = $employee->kpiEvaluation->every(fn($item) => $item->is_finalized);
            $allCompFinalized = $employee->compEvaluation->every(fn($item) => $item->is_finalized);

            $allFinalized = $allKpisFinalized && $allCompFinalized;
            $data['eval'] = Evaluation::where('employee_id', $employee->id)->where('position_id', $employee->position->id)->first();

            $html = view('manager.evaluation.emp_eval', [
                'position_kpis' => $data['position_kpis'],
                'competencies' => $data['competencies'],
                'employee' => $data['employee'],
                'final' => $data['eval'],
            ])->render();

            return response()->json(['html' => $html, 'allFinalized' => $allFinalized]);

        }

    }

    public function storeEmpEval(Request $request)
    {
        //dd($request);
        $final = $request->action === "final_submit" ? 1 : 0;
        //dd($request->kpis ,$final);

        try {
            DB::beginTransaction();
            if (!empty($request->kpis)) {
                for ($i = 0; $i < count($request['kpis']); $i++) {
                    if (
                        !isset($request['kpis'][$i]) ||
                        !isset($request['score'][$i]) ||
                        !isset($request['weighted_score'][$i])
                    ) {
                        dd($request);
                        continue;
                    }
                    $kpiId = $request['kpis'][$i];
                    EmployeeKpiEvaluation::updateOrCreate(
                        [
                            'employee_id' => $request->employee_id,
                            'kpi_id' => $kpiId,
                            'created_by' => Auth::id(),
                        ],
                        [
                            'score' => $request['score'][$i],
                            'weighted_score' => $request['weighted_score'][$i],
                            'is_finalized' => $final,
                            'updated_by' => Auth::id(),
                        ]
                    );

                }
            }


            for ($i = 0; $i < count($request['competency_id']); $i++) {
                $compID = $request->competency_id[$i];
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
                        'created_by' => Auth::id(),
                    ],
                    [
                        'score' => $request->compScore[$compID],
                        'is_finalized' => $final,
                        'updated_by' => Auth::id(),
                    ]
                );


            }
            //dd($request);

            $exists = Evaluation::where('employee_id', $request->employee_id)
                ->where('position_id', $request->emp_posiyion_id)
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
                'is_finalized' => $final,

            ]);


            DB::commit();
            toast('success', 'Data saved successfully!');
            return redirect()->route('evaluate');

        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            throw $ex;
        }
    }

    public function fetchEvaluations()
    {
        return view('evaluation.index');
    }

    public function getAllEvaluations(Request $request)
    {
        $employee = Employee::with(['position.positionKpis', 'evaluations.createdBy.employee'])->get();

//dd($employee);
        return DataTables::of($employee)
            ->addIndexColumn()
            ->editColumn('Employee', function ($employee) {
                return '<span>' . $employee->name_en . '<span> <br> <span>' .'(' . $employee->position->name_en . ' )'.'</span>';
            })
//            ->editColumn('Target', function ($employee) {
//                $allTargets = $employee->position->positionKpis->every(fn($posKpi) => $posKpi->target);
//
//                return $allTargets
//                    ? '<span class="badge bg-success">Yes</span>'
//                    : '<span class="badge bg-danger">No</span>';
//            })

            ->editColumn('KPIs_Score', function ($employee) {
                return $employee->evaluations->map(fn($eval) => $eval->kpis_score)->implode('<br>') ?: '-';
            })

            // All Competencies scores
            ->editColumn('Competencies_Score', function ($employee) {
                return $employee->evaluations->map(fn($eval) => $eval->competencies_score)->implode('<br>') ?: '-';
            })
            ->editColumn('Manager', function ($employee) {
                return $employee->evaluations->map(fn($eval) => $eval->createdBy->employee->name_en ?? '-')->implode('<br>');
        })

            // Finalized status for each evaluation
            ->editColumn('Submitted', function ($employee) {
                return $employee->evaluations->map(fn($eval) => $eval->is_finalized ?
                    '<span class="badge bg-success rounded-circle text-white">yes</span>'
                    :'<span class="badge bg-danger rounded-circle text-white">No</span>')->implode('<br>');
            })
            ->addRowAttr('data-employee', fn($employee)=> $employee->id)
            ->addRowAttr('data-position',fn($employee)=>$employee->position->id)

            ->rawColumns(['Employee', 'Target','KPIs_Score','Competencies_Score', 'Manager', 'Submitted'])
            ->make('true');
    }

    public function show(Request $request){

        return view('evaluation.show_emp');
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
