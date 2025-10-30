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
        'start_date',
        'manager_id',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    protected $casts =[
        'start_date' => 'date',
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

    public function manager(){
        return $this->belongsTo(Employee::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function position(){
        return $this->belongsTo(Position::class,'position_id');
    }



}
