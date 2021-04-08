<?php

namespace App\Domains\Announcement\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditAnnouncementRequest.
 */
class EditAnnouncementRequest extends FormRequest
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
