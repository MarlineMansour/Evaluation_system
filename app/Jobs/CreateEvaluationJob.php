<?php

namespace App\Jobs;

use App\Models\Employee;
use App\Models\Evaluation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CreateEvaluationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public int $userId;
    public function __construct(int $userId)
    {
        'created_by' => $this->userId,

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $employees = Employee::with(['manager:id', 'position:id'])->get();
        foreach ($employees as $employee) {
            $exist = Evaluation::where('employee_id', $employee->id)->where('position_id', $employee->position_id)->exists();
            if ($exist) {
                continue;
            } else {
                Evaluation::create([
                    'employee_id' => $employee->id,
                    'position_id' => $employee->position_id,
                    'manager_id' => $employee->manager_id,
                    'kpis_score' => $employee->kpis_score ?? 0,
                    'competencies_score' => $employee->competencies_score ?? 0,
                    'total_score' => ($employee->kpis_score ?? 0) + ($employee->competencies_score ?? 0),
                    'created_by' => Auth::id(),
                ]);
            }
        }
    }
}
