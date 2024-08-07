<?php

namespace Modules\File\app\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Modules\Account\app\Contracts\Repositories\UserRepositoryInterface;
use Modules\Account\app\Http\Resources\UserCollection;
use Modules\Account\app\Http\Resources\UserResource;
use Modules\Account\app\Models\Permission;
use Modules\Account\app\Models\Role;
use Modules\Account\app\Models\User;
use Modules\File\app\Contracts\Repositories\FileRepositoryInterface;
use Modules\File\app\Models\File;

class FileRepository implements FileRepositoryInterface
{

    public function all()
    {
        return File::all();
    }

    public function create(array $data)
    {
        return File::create($data);
    }

    public function find($id)
    {
        return File::find($id);
    }

    public function update(File $file, array $data)
    {
        $file->update($data);
        return $file;
    }

    public function delete(File $file)
    {
        return $file->delete();
    }

    public function forceDelete(File $file)
    {
        return $file->forceDelete();
    }

    public function isFileRowExists($user_id, $type)
    {
        return File::where('user_id', $user_id)
            ->where('type', $type)
            ->first();
    }

}
