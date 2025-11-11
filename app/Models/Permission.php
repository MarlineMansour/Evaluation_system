<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;

 class Permission extends SpatiePermission
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'guard_name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }


}
