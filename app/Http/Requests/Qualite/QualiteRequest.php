<?php

namespace App\Http\Requests\Qualite;

use Illuminate\Foundation\Http\FormRequest;

class QualiteRequest extends FormRequest
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
            'qualite_fr' => 'required|unique:qualites,qualite_fr|max:200',
            'qualite_ar' => 'required|unique:qualites,qualite_ar|max:200',

        ];
    }

    public function  messages()
    {
        return [
            'qualite_fr.required' => __('qualites.qualite_fr required'),
            'qualite_fr.max' => __('qualites.qualite_fr max'),
            'qualite_fr.unique' => __('qualites.qualite_fr unique'),

            'qualite_ar.required' => __('qualites.qualite_ar required'),
            'qualite_ar.max' => __('qualites.qualite_ar max'),
            'qualite_ar.unique' => __('qualites.qualite_ar unique'),
        ];
    }
}
