<?php

namespace App\Domains\Social\Http\Requests\Backend\Ads;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreAdsRequest.
 */
class StoreAdsRequest extends FormRequest
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
            'ads_banner' => ['required', 'image', 'dimensions:width=1920,height=1080'],
            'number_max' => ['required', 'integer', 'max:1000'],
            'number_min' => ['required', 'integer', 'min:1'],
            'incidence' => ['required', 'integer', 'min:1', 'max:10000'],
            'payment' => ['sometimes', 'in:1'],
            'active' => ['sometimes', 'in:1'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
        ];
    }
}
