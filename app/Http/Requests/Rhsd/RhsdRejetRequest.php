<?php

namespace App\Http\Requests\Rhsd;

use Illuminate\Foundation\Http\FormRequest;

class RhsdRejetRequest extends FormRequest
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
            'motif' => 'required'
        ];
    }

    public function  messages()
    {
        return [
            'motif.required' => __('rhsd.motif required'),

        ];
    }
}
