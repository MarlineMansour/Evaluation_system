<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{

    protected $fillable = [
        'name_en',
        'name_ar',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    public function createdBy(){
        return $this->belongTo(User::class);
    }

    public function updatedBy(){
        return $this->belongTo(User::class);
    }

    public function deletedBy(){
        return $this->belongTo(User::class);
    }

    public function relatedToDepartment(){
        return $this->belongTo(Department::class);
     }
}
