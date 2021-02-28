<?php

namespace App\Http\Requests\Actions;

use Illuminate\Foundation\Http\FormRequest;

class ActionRequest extends FormRequest
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
            'action_fr' => 'required|unique:actions,action_fr|max:200',
            'action_ar' => 'required|unique:actions,action_ar|max:200',

        ];
    }
    public function messages()
    {
        return [
            'action_fr.required' => __('actions.action_fr required'),
            'action_fr.max' => __('actions.action_fr max'),
            'action_fr.unique' => __('actions.action_fr unique'),

            'action_ar.required' => __('actions.action_ar required'),
            'action_ar.max' => __('actions.action_ar max'),
            'action_ar.unique' => __('actions.action_ar unique'),

        ];
    }
}
