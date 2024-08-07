<?php

namespace Modules\File\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\File\app\Services\StorageManagerService;

class File extends Model
{

    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name', 'description', 'type', 'path', 'is_public', 'verified', 'size', 'mime_type', 'fileable_type', 'fileable_id','user_id'
    ];

    public function absolutePath()
    {
        return resolve(StorageManagerService::class)->getAbsolutePathOf($this->name . $this->type, $this->is_public);
    }

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

}
