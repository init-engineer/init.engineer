<?php

namespace App\Domains\Companie\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreCompanieRequest.
 */
class StoreCompanieRequest extends FormRequest
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
            'logo' => ['nullable', 'image', 'dimensions:width=512,height=512', 'max:10240'],
            'banner' => ['nullable', 'image', 'dimensions:width=1280,height=720', 'max:10240'],
            'pictures.*' => ['nullable', 'image', 'max:2048'],
            'area' => ['required', Rule::in([
                '臺北市', '新北市', '桃園市', '臺中市', '臺南市',
                '高雄市', '基隆市', '新竹市', '嘉義市', '新竹縣',
                '苗栗縣', '彰化縣', '南投縣', '雲林縣', '嘉義縣',
                '屏東縣', '宜蘭縣', '花蓮縣', '臺東縣', '澎湖縣',
                '金門縣', '連江縣', '海外',
            ])],
            'address' => ['required', 'string', 'max:191'],
            'scale' => ['nullable', 'integer'],
            'tax' => ['nullable', 'string', 'max:8'],
            'capital' => ['nullable', 'integer'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string', 'max:2000'],
            'content' => ['sometimes', 'array'],
        ];
    }
}
