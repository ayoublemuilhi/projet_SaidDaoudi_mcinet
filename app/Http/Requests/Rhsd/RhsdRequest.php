<?php

namespace App\Http\Requests\Rhsd;

use Illuminate\Foundation\Http\FormRequest;

class RhsdRequest extends FormRequest
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
            'qualite' => 'required',
            'domaine' => 'required',
            'axe' => 'required',
            'date_creation' => 'required',
            'objectif' => 'required|numeric|gte:0',
            'realisation' => 'required|numeric|gte:0',
            'ecart' => 'numeric',


        ];
    }

    public function  messages()
    {
        return [
            'qualite.required' => __('rhsd.qualite required'),
            'domaine.required' => __('rhsd.domaine required'),
            'axe.required' => __('rhsd.axe required'),
            'date_creation.required' => __('rhsd.date_creation required'),

            'objectif.required' => __('rhsd.objectif required'),
            'objectif.numeric' => __('rhsd.objectif numeric'),
            'objectif.gte' => __('rhsd.objectif gte'),

            'realisation.required' => __('rhsd.realisation required'),
            'realisation.numeric' => __('rhsd.realisation numeric'),

            'realisation.gte' => __('rhsd.realisation gte'),

            'ecart.numeric' => __('rhsd.ecart numeric'),


        ];
    }
}
