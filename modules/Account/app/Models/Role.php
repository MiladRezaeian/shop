<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Account\app\Services\Permission\Traits\HasPermissions;

class Role extends Model
{
    use HasFactory, HasPermissions;

    protected $fillable = ['name', 'translated_name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
