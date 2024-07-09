<?php

namespace Modules\Account\app\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Modules\Account\app\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Account\app\Http\Resources\UserCollection;
use Modules\Account\app\Http\Resources\UserResource;
use Modules\Account\app\Models\Permission;
use Modules\Account\app\Models\Role;
use Modules\Account\app\Models\User;

class PermissionRepository implements RoleRepositoryInterface
{

    public function getAllWithRoles(Request $request)
    {
        $query = $this->applyFilters($request);

        return new UserCollection($query->get());
    }

    private function applyFilters($request)
    {
        $query = User::query();
        $search = $request->input('search');

        $this->applySearch($query, $search);
        $this->applyIncludes($query);
        $this->applyPagination($query, $request);

        return $query;
    }

    private function applySearch($query, $search)
    {
        if($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    private function applyIncludes($query)
    {
        return $query->with('roles');
    }

    private function applyPagination($query, $request)
    {
        return $query->paginate($request->input('perPage', 10));
    }

    public function getUserDataWithRolesAndPermissions(User $user)
    {
        $user->load(['roles', 'permissions']);

        return new UserResource($user);
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

}
