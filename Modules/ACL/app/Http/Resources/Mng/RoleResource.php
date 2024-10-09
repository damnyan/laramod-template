<?php

namespace Modules\ACL\Http\Resources\Mng;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ACL\Http\Resources\Mng\PermissionResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'permissions' => $this->whenAppended(
                'permissions',
                PermissionResource::collection($this->permissions)
            ),
        ];
    }
}
