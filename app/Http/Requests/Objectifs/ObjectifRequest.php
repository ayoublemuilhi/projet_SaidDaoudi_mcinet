<?php

namespace App\Http\Requests\Objectifs;

use Illuminate\Foundation\Http\FormRequest;

class ObjectifRequest extends FormRequest
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
            'objectif_fr' => 'required|unique:objectifs,objectif_fr|max:255',
            'objectif_ar' => 'required|unique:objectifs,objectif_ar|max:255',
            'secteur' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'objectif_fr.required' => __('objectifs.objectif_fr required'),
            'objectif_fr.max' => __('objectifs.objectif_fr max'),
            'objectif_fr.unique' => __('objectifs.objectif_fr unique'),

            'objectif_ar.required' => __('objectifs.objectif_ar required'),
            'objectif_ar.max' => __('objectifs.objectif_ar max'),
            'objectif_ar.unique' => __('objectifs.objectif_ar unique'),
            'secteur.required' => __('objectifs.secteur required')
        ];
    }
}
