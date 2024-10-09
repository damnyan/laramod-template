<?php

namespace Modules\Administrator\Http\Requests\Mng;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class SyncRolesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'roles' => ['required', 'array'],
            'roles.*' => [
                'required',
                Rule::exists(
                    table: Role::class,
                    column: 'name'
                ),
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
