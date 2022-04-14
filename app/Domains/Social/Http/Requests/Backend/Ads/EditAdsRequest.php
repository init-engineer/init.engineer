<?php

namespace App\Domains\Social\Http\Requests\Backend\Ads;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditAdsRequest.
 */
class EditAdsRequest extends FormRequest
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
            //
        ];
    }
}
