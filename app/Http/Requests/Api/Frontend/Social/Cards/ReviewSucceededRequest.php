<?php

namespace App\Http\Requests\Api\Frontend\Social\Cards;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ReviewSucceededRequest.
 */
class ReviewSucceededRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isActive();
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
