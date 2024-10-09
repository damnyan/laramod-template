<?php

namespace Modules\ACL\Enums;

use Modules\Common\Enums\Traits\ToArray;

enum AdministratorPermission: string implements Permission
{
    use ToArray;

    case ROLE_MNG = 'Role Management';
    case ADMIN_MNG = 'Administrator Management';
}
