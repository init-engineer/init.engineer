<?php

namespace App\Domains\Announcement\Http\Requests\Backend;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateAnnouncementRequest.
 *
 * @extends FormRequest
 */
class UpdateAnnouncementRequest extends FormRequest
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
            'type' => ['required', Rule::in([
                Announcement::TYPE_PRIMARY,
                Announcement::TYPE_SECONDARY,
                Announcement::TYPE_SUCCESS,
                Announcement::TYPE_DANGER,
                Announcement::TYPE_WARNING,
                Announcement::TYPE_INFO,
                Announcement::TYPE_LIGHT,
                Announcement::TYPE_DARK
            ])],
            'area' => ['required', Rule::in([
                'all',
                Announcement::AREA_FRONTEND,
                Announcement::AREA_BACKEND
            ])],
            'message' => ['required', 'string'],
            'starts_at_date' => ['nullable', 'date'],
            'starts_at_time' => ['nullable'],
            'ends_at_date' => ['nullable', 'date'],
            'ends_at_time' => ['nullable'],
            'enabled' => ['sometimes', 'in:1'],
        ];
    }
}
