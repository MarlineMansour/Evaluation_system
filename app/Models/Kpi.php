<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kpi extends Model
{
use SoftDeletes;
    protected $fillable = [
        'name_en',
        'name_ar',
        'baseline',
        'is_linear',
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
    public function evaluation(){
        return $this->hasMany(EmployeeKpiEvaluation::class,'kpi_id');
    }
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'position_kpis')
            ->using(PositionKPI::class)
            ->withPivot(['target', 'weight', 'is_finalized'])
            ->withTimestamps();
    }

    public function positionKpis()
    {
        return $this->hasMany(PositionKPI::class, 'kpi_id');
    }
}
