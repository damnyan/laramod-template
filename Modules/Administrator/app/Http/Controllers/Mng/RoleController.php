<?php

namespace Modules\Administrator\Http\Controllers\Mng;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Modules\Administrator\Http\Requests\Mng\SyncRolesRequest;
use Modules\Administrator\Models\Administrator;

/**
 * @tags Mng Administrator Role
 */
class RoleController extends Controller
{
    /**
     * Sync Roles
     *
     * @param SyncRolesRequest $request
     * @param Administrator $administrator
     * @return Response
     */
    public function syncRoles(
        SyncRolesRequest $request,
        Administrator $administrator
    ): Response {
        $administrator->syncRoles($request->roles);

        return response()->noContent();
    }
}
