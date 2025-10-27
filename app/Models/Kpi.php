<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{

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
        return $this->belongTo(User::class);
    }

    public function updatedBy(){
        return $this->belongTo(User::class);
    }
    public function deletedBy(){
        return $this->belongTo(User::class);
    }
}
