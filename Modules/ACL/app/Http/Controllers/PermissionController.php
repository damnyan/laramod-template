<?php

namespace Modules\ACL\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\ACL\Http\Resources\Mng\PermissionResource;
use Modules\Common\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

/**
 * @tags Mng ACL Permission
 */
class PermissionController extends Controller
{
    /**
     * Index
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $permissions = Permission::paginate(
            $this->getPerPage()
        );

        return PermissionResource::collection(resource: $permissions);
    }
}
