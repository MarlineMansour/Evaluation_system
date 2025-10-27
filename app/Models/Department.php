<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $fillable = [
        'name_en',
        'name_ar',
        'manager_id',
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

    public function hasCompetencies(){
        return $this->hasMany(Competency::class);
    }
    public function hasPosition(){
        return $this->hasMany(Position::class);
    }
    public function hasManager(){
        return $this->belongTo(Employee::class);
    }

}
