<?php

namespace Modules\File\app\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\File\app\Constants\FileConstants;
use Modules\File\app\Contracts\Repositories\FileRepositoryInterface;
use Modules\File\app\Contracts\Services\FileServiceInterface;
use Modules\File\app\Contracts\Services\StorageManagerInterface;
use Modules\File\app\Models\File;

class FileService implements FileServiceInterface
{

    private FileRepositoryInterface $fileRepository;
    private StorageManagerInterface $storageManagerService;
    public function __construct(FileRepositoryInterface $fileRepository, StorageManagerService $storageManagerService)
    {
        $this->fileRepository = $fileRepository;
        $this->storageManagerService = $storageManagerService;
    }

    public function store($model, $file, $type, $path = null, $description = null)
    {
        $user_id = auth()->id();
        $fileName = $user_id . '_' . $file->getClientOriginalName();
        $isPublic = $this->checkTypeIsPublic($type);
        $verified = 1;
        $size = $file->getSize();
        $fileable_type = get_class($model);
        $fileable_id = $model->id;
        $mime_type = $file->getClientMimeType();

        if (!$path) {
            $path = $this->generateFileBasePathByType($type);
        }

        $path = $this->upload($file, $fileName, $path, $isPublic);

        $data = [
            'name' => $fileName,
            'description' => $description,
            'type' => $type,
            'path' => $path,
            'is_public' => $isPublic,
            'verified' => $verified,
            'size' => $size,
            'mime_type' => $mime_type,
            'fileable_type' => $fileable_type,
            'fileable_id' => $fileable_id,
            'user_id' => $user_id,
        ];

        if ($this->isReplaceable($type)) {

            try {

                $existsFileRow = $this->fileRepository->isFileRowExists($user_id, $type);

                DB::transaction(function () use ($isPublic, $fileName, $data, $existsFileRow) {

                    if ($existsFileRow instanceof File) {
                        $this->fileRepository->forceDelete($existsFileRow);

                        if ($this->storageManagerService->isFileExists($existsFileRow->path, $existsFileRow->is_public ) && $fileName != $existsFileRow->name) {
                            $this->storageManagerService->deleteFile($existsFileRow->path, $existsFileRow->is_public); //TODO issue of deleting exists file that have uploaded
                        }
                    }

                    return $this->fileRepository->create($data);
                });
            } catch (\Exception $e) {
                Log::error('Error creating file: ' . $e->getMessage());

                return false;
            }
        }else{
            return $this->fileRepository->create($data);
        }
    }

    private function upload($file, $fileName, $path, $isPublic): string
    {
        return $this->storageManagerService->putFile($fileName, $file, $path, $isPublic);
    }

    private function checkTypeIsPublic($type): bool
    {
        $fileTypes = FileConstants::FILE_TYPES_DETAILS;
        return $fileTypes[$type]['is_public'] ?? false;
    }

    private function generateFileBasePathByType($type): ?string
    {
        $fileTypes = FileConstants::FILE_TYPES_DETAILS;
        return $fileTypes[$type]['directory'] ?? null;
    }

    private function isReplaceable($type): bool
    {
        $fileTypes = FileConstants::FILE_TYPES_DETAILS;
        return $fileTypes[$type]['replaceable'] ?? false;
    }
}
