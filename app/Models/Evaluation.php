<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table= 'evaluation';
    protected $fillable = [
        'employee_id',
        'manager_id',
        'position_id',
        'kpis_score',
        'competencies_score',
        'total_score',
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
}
