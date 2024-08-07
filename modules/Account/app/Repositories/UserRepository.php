<?php

namespace Modules\Account\app\Repositories;

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

class UserRepository implements UserRepositoryInterface
{

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllWithRolesAndSearchCriteria($params)
    {
        $users = $this->applySearchFilters($params);

        $users->load('roles');

        return $users;
    }

    public function getDataWithRolesAndPermissions(User $user)
    {
        $user->load(['roles', 'permissions']);

        return $user;
    }

    public function create(array $data): User
    {
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'national_id' => $data['national_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update(array $data, User $user): User
    {
        $user->username = $data['username'];
        $user->name = $data['name'];
        $user->national_id = $data['national_id'];
        $user->email = $data['email'];

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return $user;
    }

    public function destroy(User $user)
    {
        return $user->delete();
    }

    public function search($params)
    {
        $users = $this->applySearchFilters($params);

        return $users;

    }

    private function applySearchFilters($params)
    {
        $query = $this->user->newQuery();

        $name = $params['name'] ?? null;
        $email = $params['email'] ?? null;
        $nationalId = $params['national_id'] ?? null;

        if (!empty($name)) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (!empty($email)) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }

        if (!empty($nationalId)) {
            $query->where('national_id', 'like', '%' . $params['national_id'] . '%');
        }

        return $query->paginate();
    }

}
