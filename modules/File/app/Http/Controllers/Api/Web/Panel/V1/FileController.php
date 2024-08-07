<?php

namespace Modules\File\app\Http\Controllers\Api\Web\Panel\V1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Response;
use Modules\File\app\Contracts\Services\FileServiceInterface;
use Modules\File\app\Http\Requests\Api\Web\Panel\V1\FileRequest;
use Modules\File\app\Models\File;

class FileController extends BaseController
{

    private FileServiceInterface $fileService;

    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    public function store(FileRequest $request)
    {
        try {
            $file = $this->fileService->store($request);

            return $this->successWithData($file, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->errorWithData('File has already been uploadedddd.', Response::HTTP_CREATED);
        }
    }

    public function show(File $file)
    {
        $fileData = $this->fileService->show($file);

        return $this->successWithData($fileData);
    }

}
