<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_en',
        'name_ar',
        'position_id',
        'user_id',
        'start_date',
        'manager_id',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function compEvaluation()
    {
        return $this->hasMany(EmployeeCompetencyEvaluation::class, 'employee_id');
    }

    public function kpiEvaluation()
    {
        return $this->hasMany(EmployeeKpiEvaluation::class, 'employee_id');
    }

    public function finalEvaluation($position_id)
    {
        return $this->hasMany(Evaluation::class, 'employee_id')
            ->where('position_id', $position_id)->first();
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'employee_id');
    }



}
