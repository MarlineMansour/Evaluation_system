<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employeeCompetencyEvaluation extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'employee_competencies_evaluation';
    protected $fillable = [
        'employee_id',
        'competency_id',
        'score',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_finalized',
    ];
    public function createdBy(){
        return $this->belongsTo(User::class);
    }
    public function updatedBy(){
        return $this->belongsTo(User::class);
    }
    public function deletedBy(){
        return $this->belongsTo(User::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function competency(){
        return $this->belongsTo(Competency::class,'competency_id');
    }

}
