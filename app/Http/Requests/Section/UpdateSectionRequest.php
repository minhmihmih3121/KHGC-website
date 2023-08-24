<?php

namespace App\Http\Requests\Section;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermissions((array)Acl::PERMISSION_SECTION_EDIT);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'fixed_key' => ['required', 'unique:sections,' . $this->id]
        ];
    }
}
