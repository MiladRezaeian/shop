<?php

namespace Modules\File\app\Models\Traits;

use Modules\File\app\Models\File;

trait Fileable
{
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

}
