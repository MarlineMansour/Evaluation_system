<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competency extends Model
{
use SoftDeletes;
    protected $fillable = [
        'name_en',
        'name_ar',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by',

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

    public function relatedToDepartment(){
        return $this->belongsTo(Department::class,'department_id');
     }
     public function evaluation(){
        return $this->hasMany(employeeCompetencyEvaluation::class,'competency_id');
     }
}
