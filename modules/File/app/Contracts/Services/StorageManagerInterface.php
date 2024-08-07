<?php

namespace Modules\File\app\Contracts\Services;

use Illuminate\Http\UploadedFile;

interface StorageManagerInterface
{

    public function putFile($fileName, UploadedFile $file, string $path, $isPublic = false);
    public function getAbsolutePathOf(string $name, string $path, bool $isPublic): string;
    public function isFileExists(string $path, bool $isPublic);
    public function deleteFile(string $path, bool $isPublic);

}
