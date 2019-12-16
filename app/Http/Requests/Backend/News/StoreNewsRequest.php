<?php

namespace App\Http\Requests\Backend\News;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreNewsRequest.
 */
class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'image' => ['required', 'image'],
            'url' => ['required', 'string'],
            'hashtag' => ['required', 'string'],
            'layout' => ['nullable', 'string'],
            'content' => ['required', 'string'],
        ];
    }
}
