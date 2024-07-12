<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'translated_name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
