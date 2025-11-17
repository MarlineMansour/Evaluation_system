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
        'permission_group_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function group(){
        return $this->belongsTo(PermissionGroup::class,'permission_group_id');
    }


}
