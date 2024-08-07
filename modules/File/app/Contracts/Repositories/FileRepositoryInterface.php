<?php

namespace Modules\File\app\Contracts\Repositories;

use Modules\File\app\Http\Requests\Api\Web\Panel\V1\FileRequest;
use Modules\File\app\Models\File;

interface FileRepositoryInterface
{

    public function all();
    public function create(array $data);

    public function find($id);

    public function update(File $file, array $data);

    public function delete(File $file);

    public function forceDelete(File $file);

    public function isFileRowExists($user_id, $type);

}
