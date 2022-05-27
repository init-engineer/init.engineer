<?php

namespace App\Domains\Social\Http\Requests\Api\Publish;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class PublishArticleRequest.
 */
class PublishArticleRequest extends FormRequest
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
            'content' => ['required', 'string', 'min:30', 'max:4096'],
            'config.theme' => ['required', 'string', Rule::in([
                'black-green',
                'black-yellow',
                'black-white',
                'black-red',
                'sweet-panda',
                'blue-white',
                'white-blue',
                'laravel',
                'soft-green',
                'grey-pikachu',
                'grey-eevee',
                'pikachu-grey',
                'eevee-grey',
                'chinese-new-year',
                'reverse-chinese-new-year',
                'devotion',
                'windows-10-error',
                'windows-10-error-testing',
                'pink',
                'broken-think',
                'furry-broken-think',
            ])],
            'config.font' => ['required', 'string', Rule::in([
                'auraka',
                'kc24m',
                'microsoft-jheng-hei',
                'mingliu',
                'kaiu',
                'fot-matissepro-eb',
                'taipei-sans-tc-beta-bold',
                'cubic-11',
                'huninn',
                'glow-sans',
            ])],
        ];
    }
}
