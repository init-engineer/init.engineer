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
            'name' => ['required', 'string'],
            'action' => ['required', Rule::in([
                Platform::ACTION_INACTION,
                Platform::ACTION_NOTIFICATION,
                Platform::ACTION_PUBLISH,
            ])],
            'type' => ['required', Rule::in([
                Platform::TYPE_LOCAL,
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
                Platform::TYPE_TUMBLR,
                Platform::TYPE_TELEGRAM,
                Platform::TYPE_DISCORD,
            ])],
            'active' => ['sometimes', 'in:1'],
            'user_id' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TUMBLR,
            ))],
            'consumer_app_id' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_PLURK,
            ))],
            'consumer_app_key' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_TWITTER,
                Platform::TYPE_TUMBLR,
            ))],
            'consumer_app_secret' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
                Platform::TYPE_TUMBLR,
            ))],
            'graph_version' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_FACEBOOK,
            ))],
            'access_token' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
                Platform::TYPE_TUMBLR,
                Platform::TYPE_TELEGRAM,
            ))],
            'access_token_secret' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
                Platform::TYPE_TUMBLR,
            ))],
            'chat_id' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_TELEGRAM,
            ))],
            'webhook' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_DISCORD,
            ))],
            'pages_name' => ['required_if:' . implode(',', array(
                'type',
                Platform::TYPE_FACEBOOK,
                Platform::TYPE_TWITTER,
                Platform::TYPE_PLURK,
            ))],
        ];
    }
}
