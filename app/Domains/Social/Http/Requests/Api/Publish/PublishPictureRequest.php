<?php

namespace App\Domains\Social\Http\Requests\Api\Publish;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PublishPictureRequest.
 */
class PublishPictureRequest extends FormRequest
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
            'content' => ['required', 'string', 'min:30', 'max:4096'],
            'picture' => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
        ];
    }
}
