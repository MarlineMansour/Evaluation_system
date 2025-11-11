<?php


namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SoftDeletes;
    // Add your custom relationships, accessors, or methods here
    protected $fillable =
        ['name',
        'guard_name',
        'description',
        'created_by',
        'updated_by',
        'deleted_by'
        ];

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }
}
