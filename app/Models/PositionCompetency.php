<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionCompetency extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'position_id',
        'competency_id',
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
}
