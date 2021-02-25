<?php

namespace App\Http\Requests\Indicateurs;

use Illuminate\Foundation\Http\FormRequest;

class IndicateurRequest extends FormRequest
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
            'indicateur_fr' => 'required|unique:indicateurs,indicateur_fr|max:255',
            'indicateur_ar' => 'required|unique:indicateurs,indicateur_ar|max:255',
        ];
    }
    public function messages()
    {
        return [
            'indicateur_fr.required' => __('indicateurs.indicateur_fr required'),
            'indicateur_fr.max' => __('indicateurs.indicateur_fr max'),
            'indicateur_fr.unique' => __('indicateurs.indicateur_fr unique'),

            'indicateur_ar.required' => __('indicateurs.indicateur_ar required'),
            'indicateur_ar.max' => __('indicateurs.indicateur_ar max'),
            'indicateur_ar.unique' => __('indicateurs.indicateur_ar unique')
        ];
    }
}
