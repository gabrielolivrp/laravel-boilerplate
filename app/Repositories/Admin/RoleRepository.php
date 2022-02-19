<?php

namespace App\Repositories\Admin;

use App\Events\Admin\Role\RoleDestroyed;
use App\Events\Admin\Role\RoleUpdated;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\Role;
use Exception;
use App\Events\Admin\Role\RoleCreated;

class RoleRepository extends BaseRepository
{
    /**
     * RoleRepository constructor.
     * @param Role $role
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @param array $data
     * @return Role
     * @throws GeneralException|\Throwable
     */
    public function store(array $data): Role
    {
        DB::beginTransaction();

        try {
            $role = $this->model::create([
                'name' => $data['name'],
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($data['permissions'] ?? []);

            event(new RoleCreated($role));
        } catch (Exception) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this role. Please try again.'));
        }

        DB::commit();

        return $role;
    }

    /**
     * @param Role $role
     * @param array $data
     * @return Role
     * @throws GeneralException|\Throwable
     */
    public function update(Role $role, array $data): Role
    {
        DB::beginTransaction();

        try {

            $role->update([
                'name' => $data['name'],
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($data['permissions'] ?? []);

            event(new RoleUpdated($role));
        } catch (Exception) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this role. Please try again.'));
        }

        DB::commit();

        return $role;
    }

    /**
     * @param Role $role
     * @return Role
     * @throws GeneralException
     * @throws Exception
     */
    public function delete(Role $role): Role
    {
        if ($role->delete()) {
            event(new RoleDestroyed($role));

            return $role;
        }

        throw new GeneralException(__('There was a problem deleting this role. Please try again.'));
    }
}
