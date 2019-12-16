<?php

namespace App\Http\Requests\Backend\News;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateNewsRequest.
 */
class UpdateNewsRequest extends FormRequest
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
            'title' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'url' => ['nullable', 'string'],
            'hashtag' => ['nullable', 'string'],
            'layout' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
        ];
    }
}
