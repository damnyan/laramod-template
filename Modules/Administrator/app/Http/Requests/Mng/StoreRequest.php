<?php

namespace Modules\Administrator\Http\Requests\Mng;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Administrator\Models\Administrator;
use Modules\File\Rules\FileExists;
use Spatie\Permission\Models\Role;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique(table: Administrator::class, column: 'email')
                    ->withoutTrashed()
            ],
            'password' => ['required', Password::default()],
            'face_url' => ['nullable', new FileExists()],
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'roles' => ['array', 'required'],
            'roles.*' => [
                Rule::exists(table: Role::class, column: 'name')
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
