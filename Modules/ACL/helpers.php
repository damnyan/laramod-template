<?php

use Modules\ACL\Helpers\Middleware;
use Modules\ACL\Enums\Permission;

if (!function_exists('permission')) {
    function permission(Permission ...$permission): string {
        return Middleware::permission(...$permission);
    }
}
