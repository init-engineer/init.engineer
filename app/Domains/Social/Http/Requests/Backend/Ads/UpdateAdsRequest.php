<?php

namespace App\Domains\Social\Http\Requests\Backend\Ads;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAdsRequest.
 */
class UpdateAdsRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'ads_banner' => ['nullable', 'image', 'dimensions:width=960,height=240'],
            'probability' => ['required', 'integer', 'min:1', 'max:10000'],
            'payment' => ['sometimes', 'in:1'],
            'active' => ['sometimes', 'in:1'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
        ];
    }
}
