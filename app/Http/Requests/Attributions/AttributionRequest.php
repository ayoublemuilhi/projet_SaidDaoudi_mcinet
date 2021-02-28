<?php

namespace App\Http\Requests\Attributions;

use Illuminate\Foundation\Http\FormRequest;

class AttributionRequest extends FormRequest
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
            'attribution_fr' => 'required|unique:attributions,attribution_fr|max:250',
            'attribution_ar' => 'required|unique:attributions,attribution_ar|max:250',
            'secteur' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'attribution_fr.required' => __('attributions.attribution_fr required'),
            'attribution_fr.max' => __('attributions.attribution_fr max'),
            'attribution_fr.unique' => __('attributions.attribution_fr unique'),

            'attribution_ar.required' => __('attributions.attribution_ar required'),
            'attribution_ar.max' => __('attributions.attribution_ar max'),
            'attribution_ar.unique' => __('attributions.attribution_ar unique'),

            'secteur.required' => __('attributions.secteur required')
        ];
    }
}
