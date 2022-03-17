<?php

namespace App\Domains\Auth\Http\Requests\Backend\Role;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRoleRequest.
 *
 * @extends FormRequest
 */
class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in([
                User::TYPE_ADMIN,
                User::TYPE_USER,
            ])],
            'name' => ['required', 'max:100', Rule::unique('roles')],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => [Rule::exists('permissions', 'id')->where('type', $this->type)],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this role type.'),
        ];
    }
}
