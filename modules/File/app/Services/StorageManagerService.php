<?php

namespace Modules\File\app\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\File\app\Contracts\Services\StorageManagerInterface;

class StorageManagerService implements StorageManagerInterface
{
    public function putFile($fileName, UploadedFile $file, string $path, $isPublic = false)
    {
        $savedPath = $this->getDisk($isPublic)->putFileAs($path, $file, $fileName);
        $fullPath = $this->getDisk($isPublic)->url($savedPath);

        $baseUrl = config('app.url');
        $relativePath = str_replace($baseUrl . '/storage/', '', $fullPath); // Remove the "/storage" prefix //TODO

        return $relativePath;
    }

    public function getAbsolutePathOf(string $name, string $path, bool $isPublic): string
    {
        return $this->getDisk($isPublic)->path($this->directoryPrefix($path, $name));
    }

    public function isFileExists(string $path, bool $isPublic)
    {
        $relativePath = str_replace('private/', '', $path); //TODO
        return $this->getDisk($isPublic)->exists($relativePath);
    }

    public function deleteFile(string $path, bool $isPublic)
    {
        $relativePath = str_replace('private/', '', $path); //TODO
        return $this->getDisk($isPublic)->delete($relativePath);
    }

    private function getDisk(bool $isPublic)
    {
        return $isPublic ? Storage::disk('public') : Storage::disk('private');
    }

    private function directoryPrefix($path, $name)
    {
        return $path . DIRECTORY_SEPARATOR . $name;
    }

}
