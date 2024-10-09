<?php

namespace Modules\ACL\Http\Requests\Mng;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\ACL\Enums\AdministratorPermission;
use Spatie\Permission\Models\Role;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:100',
                Rule::unique(
                    table: Role::class,
                    column: 'name',
                )->ignore(id: $this->role->id, idColumn: 'id'),
            ],
            'permissions' => ['required', 'array'],
            'permissions.*' => [
                'required',
                Rule::in(values: AdministratorPermission::toArray())
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
