<?php

namespace App\Http\Requests\Api\Frontend\Social\Cards;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCardsRequest.
 */
class StoreCardsRequest extends FormRequest
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
            'content' => ['required', 'string', 'min:30'],
            'themeStyle' => ['required', 'string'],
            'fontStyle' => ['required', 'string'],
            'avatar' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
        ];
    }
}
