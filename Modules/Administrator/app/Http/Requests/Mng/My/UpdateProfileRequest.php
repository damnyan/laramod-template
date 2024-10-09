<?php

namespace Modules\Administrator\Http\Requests\Mng\My;

use Illuminate\Foundation\Http\FormRequest;
use Modules\File\Rules\FileExists;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'face_url' => ['required', new FileExists()],
            'first_name' => ['required', 'max:200'],
            'middle_name' => ['nullable', 'max:200'],
            'last_name' => ['required', 'max:200'],
            'suffix' => ['nullable', 'max:10'],
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
