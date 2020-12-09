<?php

namespace App\Domains\Social\Http\Requests\Backend\Platform;

use App\Domains\Social\Models\Platform;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StorePlatformRequest.
 */
class StorePlatformRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'platformName' => ['required', Rule::in([
                Platform::PLATFORM_PRIMARY,
                Platform::PLATFORM_SECONDARY,
                Platform::PLATFORM_TESTING,
            ])],
            'platformType' => ['required', Rule::in([
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
            ])],
            'active' => ['sometimes', 'in:1'],
            'user_id' => ['required_if:name,' . Platform::TYPE_FACEBOOK],
            'app_id' => ['required_if:name,' . Platform::TYPE_FACEBOOK],
            'app_secret' => ['required_if:name,' . Platform::TYPE_FACEBOOK],
            'graph_version' => ['required_if:name,' . Platform::TYPE_FACEBOOK],
            'access_token' => ['required_if:name,' . Platform::TYPE_FACEBOOK . ',' . Platform::TYPE_TWITTER],
            'access_token_secret' => ['required_if:name,' . Platform::TYPE_TWITTER],
            'consumer_key' => ['required_if:name,' . Platform::TYPE_TWITTER],
            'consumer_secret' => ['required_if:name,' . Platform::TYPE_TWITTER],
            'client_id' => ['required_if:name,' . Platform::TYPE_PLURK],
            'client_secret' => ['required_if:name,' . Platform::TYPE_PLURK],
            'token' => ['required_if:name,' . Platform::TYPE_PLURK],
            'token_secret' => ['required_if:name,' . Platform::TYPE_PLURK],
            'pages_name' => ['required', 'string', 'max:191'],
        ];
    }
}
