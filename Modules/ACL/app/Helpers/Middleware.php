<?php

namespace Modules\ACL\Helpers;

use Modules\ACL\Enums\Permission;

class Middleware
{
    /**
     * Permission
     *
     * @param Permission ...$permissions
     * @return string
     */
    public static function permission(Permission ...$permissions): string
    {
        $middleware = 'permission:';

        foreach ($permissions as $permission) {
            /** @var Permission $permission */
            $middleware .= $permission->value . '|';
        }

        return substr($middleware, 0, -1);
    }
}
