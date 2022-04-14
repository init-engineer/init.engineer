<?php

namespace App\Domains\Social\Http\Requests\Api\Comments;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCommentsRequest.
 */
class StoreCommentsRequest extends FormRequest
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
            'comments' => ['required', 'string', 'min:6'],
        ];
    }
}
