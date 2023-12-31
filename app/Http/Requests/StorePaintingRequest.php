<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaintingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'painting' => [
                'name_ua' => 'required',
                'name_en' => 'required',
//                'price' => 'required',
//                'description_ua' => 'required',
//                'description_en' => 'required',
                'material' => 'required',
                'style' => 'required',
                'height' => 'required',
                'long' => 'required',
                'category_id' => 'required',
                ],
        ];
    }
}
