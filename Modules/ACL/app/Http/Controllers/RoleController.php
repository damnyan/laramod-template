<?php

namespace Modules\ACL\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Modules\ACL\Http\Requests\Mng\StoreRequest;
use Modules\ACL\Http\Requests\Mng\UpdateRequest;
use Modules\ACL\Http\Resources\Mng\RoleResource;
use Modules\Common\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

/**
 * @tags Mng ACL Role
 */
class RoleController extends Controller
{
    /**
     * List
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $roles = Role::orderBy(column: 'name', direction: 'asc')
            ->paginate($this->getPerPage())
            ->append(attributes: 'permissions');

        return RoleResource::collection(resource: $roles);
    }

    /**
     * Store
     *
     * @param StoreRequest $request
     * @return RoleResource
     */
    public function store(StoreRequest $request): RoleResource
    {
        $role = Role::create(attributes: [
            'name' => $request->name,
            'guard_name' => 'administrator'
        ]);

        $role->syncPermissions(permissions: $request->permissions);
        $role->append(attributes: 'permissions');

        return new RoleResource(resource: $role);
    }

    /**
     * Show
     *
     * @param Role $role
     * @return RoleResource
     */
    public function show(Role $role): RoleResource
    {
        $role->append(attributes: 'permissions');
        return new RoleResource(resource: $role);
    }

    /**
     * Update
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(UpdateRequest $request, Role $role): RoleResource
    {
        $role->update(attributes: $request->only('name'));
        $role->syncPermissions(permissions: $request->permissions);
        $role->append(attributes: 'permissions');

        return new RoleResource(resource: $role);
    }

    /**
     * Destroy
     *
     * @param Role $role
     * @return Response
     */
    public function destroy(Role $role): Response
    {
        $role->delete();

        return response()->noContent();
    }
}
