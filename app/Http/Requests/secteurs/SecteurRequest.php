<?php

namespace App\Http\Requests\secteurs;

use Illuminate\Foundation\Http\FormRequest;
use LaravelLocalization;
class SecteurRequest extends FormRequest
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
            'secteur_fr' => 'required|unique:secteurs,T_secteur_fr|max:250',
            'secteur_ar' => 'required|unique:secteurs,T_secteur_ar|max:250',
        ];
    }
    public function messages()
    {
        return [
            'secteur_fr.required' => __('secteurs.secteur required'),
            'secteur_fr.max' => __('secteurs.secteur max'),
            'secteur_fr.unique' => __('secteurs.secteur unique'),

            'secteur_ar.required' => __('secteurs.secteur_ar required'),
            'secteur_ar.max' => __('secteurs.secteur_ar max'),
            'secteur_ar.unique' => __('secteurs.secteur_ar unique'),


        ];
    }
}
