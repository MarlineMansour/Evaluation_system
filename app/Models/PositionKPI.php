<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionKPI extends Model
{
    use SoftDeletes;
    protected $table = "position_kpis";
    protected $fillable = [
        'position_id',
        'kpi_id',
        'target',
        'weight',
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
    public function KPIs(){
        return $this->belongsTo(Kpi::class, 'kpi_id');
    }

}
