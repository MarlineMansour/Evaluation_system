<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_en',
        'name_ar',
        'type',   //enum
        'is_active',
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

    public function belongToDepartment(){
        return $this->belongsTo(Department::class);
    }
    public function deletedBy(){
        return $this->belongsTo(User::class);
    }
     public function positionEvaluation(){
        return $this->hasMany(Evaluation::class,'position_id');
     }


}
