<?php

namespace Modules\File\app\Contracts\Services;

interface FileServiceInterface
{
    public function store($model, $file, $type, $path = null, $description = null);

}
