<?php

namespace App\Http\Requests\Unites;

use Illuminate\Foundation\Http\FormRequest;

class UniteRequest extends FormRequest
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

    public function rules()
    {
        return [
            'unite_fr' => 'required|unique:unites,unite_fr|max:250',
            'unite_ar' => 'required|unique:unites,unite_ar|max:250',
        ];
    }
    public function messages()
    {
        return [
            'unite_fr.required' => __('unites.unite_fr required'),
            'unite_fr.max' => __('unites.unite_fr max'),
            'unite_fr.unique' => __('unites.unite_fr unique'),

            'unite_ar.required' => __('unites.unite_ar required'),
            'unite_ar.max' => __('unites.unite_ar max'),
            'unite_ar.unique' => __('unites.unite_ar unique'),
        ];
    }
}
