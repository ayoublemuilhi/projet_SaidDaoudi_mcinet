<?php

namespace App\Http\Requests\Regions;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'region_fr' => 'required|unique:dr,region_fr|max:200',
            'region_ar' => 'required|unique:dr,region_ar|max:200',
        ];
    }
    public function messages()
    {
        return [
            'region_fr.required' => __('regions.region_fr required'),
            'region_fr.max' => __('regions.region_fr max'),
            'region_fr.unique' => __('regions.region_fr unique'),

            'region_ar.required' => __('regions.region_ar required'),
            'region_ar.max' => __('regions.region_ar max'),
            'region_ar.unique' => __('regions.region_ar unique'),
        ];
    }
}
