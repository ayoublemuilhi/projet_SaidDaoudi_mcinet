<?php

namespace App\Http\Requests\Axes;

use Illuminate\Foundation\Http\FormRequest;

class AxeRequest extends FormRequest
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
            'axe_fr' => 'required|unique:axes,axes_fr|max:250',
            'axe_ar' => 'required|unique:axes,axes_ar|max:250',
        ];
    }
    public function messages()
    {
        return [
            'axe_fr.required' => __('axes.axe_fr required'),
            'axe_fr.max' => __('axes.axe_fr max'),
            'axe_fr.unique' => __('axes.axe_fr unique'),

            'axe_ar.required' => __('axes.axe_ar required'),
            'axe_ar.max' => __('axes.axe_ar max'),
            'axe_ar.unique' => __('axes.axe_ar unique'),


        ];
    }
}
