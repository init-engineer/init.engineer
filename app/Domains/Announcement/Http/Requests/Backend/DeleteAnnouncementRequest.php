<?php

namespace App\Domains\Announcement\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DeleteAnnouncementRequest.
 *
 * @extends FormRequest
 */
class DeleteAnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
