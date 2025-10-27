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

}
