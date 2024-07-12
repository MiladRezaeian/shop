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

    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAllWithRoles()
    {
        $users = User::paginate();
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
        $query = $this->user->newQuery();

        if (array_key_exists('name', $params)) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (array_key_exists('email', $params)) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }

        if (array_key_exists('national_id', $params)) {
            $query->where('national_id', 'like', '%' . $params['national_id'] . '%');
        }

        if (array_key_exists('name', $params) &&
            array_key_exists('email', $params) &&
            array_key_exists('national_id', $params)) {

            $query->where(function ($q) use ($params) {
                $q->where('name', 'like', '%' . $params['name'] . '%')
                    ->where('email', 'like', '%' . $params['email'] . '%')
                    ->where('national_id', 'like', '%' . $params['national_id'] . '%');
            });

        }

        $users = $query->get();

        return $users;

    }

}
