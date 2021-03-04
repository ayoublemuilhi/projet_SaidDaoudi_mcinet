<?php

namespace App\Http\Requests\Dpci;

use Illuminate\Foundation\Http\FormRequest;

class DpciRequest extends FormRequest
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
            'domaine_fr' => 'required|unique:dpci,domaine_fr|max:200',
            'domaine_ar' => 'required|unique:dpci,domaine_ar|max:200',
            'type' => 'required',
            'region' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'domaine_fr.required' => __('dpci.Province_fr required'),
            'domaine_fr.max' => __('dpci.Province_fr max'),
            'domaine_fr.unique' => __('dpci.Province_fr unique'),

            'domaine_ar.required' => __('dpci.Province_ar required'),
            'domaine_ar.max' => __('dpci.Province_ar max'),
            'domaine_ar.unique' => __('dpci.Province_ar unique'),

            'type.required' => __('dpci.type required'),
            'region.required' => __('dpci.region required'),
        ];
    }
}
