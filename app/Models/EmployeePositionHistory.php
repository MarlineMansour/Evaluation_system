<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeePositionHistory extends Model
{
    use softDeletes;

 protected $fillable =[
     'employee_id',
     'position_id',
     'start_date',
     'end_date',
     'created_by',
     'updated_by',
     'deleted_by',
 ];

 protected $casts =[
     'start_date'=> 'date',
     'end_date'=>'date',
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

}
