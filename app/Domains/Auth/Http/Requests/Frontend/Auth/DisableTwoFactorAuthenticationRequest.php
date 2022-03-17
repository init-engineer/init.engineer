<?php

namespace App\Domains\Auth\Http\Requests\Frontend\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DisableTwoFactorAuthenticationRequest.
 *
 * @extends FormRequest
 */
class DisableTwoFactorAuthenticationRequest extends FormRequest
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
            'code' => ['required', 'max:10', 'totp_code'],
        ];
    }
}
