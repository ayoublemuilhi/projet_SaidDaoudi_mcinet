<?php

namespace App\Http\Requests\TypeCredit;

use Illuminate\Foundation\Http\FormRequest;

class TypeCreditRequest extends FormRequest
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
            'type_credit_fr' => 'required|unique:type_credits,type_credit_fr|max:200',
            'type_credit_ar' => 'required|unique:type_credits,type_credit_ar|max:200',
        ];
    }
    public function messages()
    {
        return [
            'type_credit_fr.required' => __('type_credit.type_credit_fr required'),
            'type_credit_fr.max' => __('type_credit.type_credit_fr max'),
            'type_credit_fr.unique' => __('type_credit.type_credit_fr unique'),

            'type_credit_ar.required' => __('type_credit.type_credit_ar required'),
            'type_credit_ar.max' => __('type_credit.type_credit_ar max'),
            'type_credit_ar.unique' => __('type_credit.type_credit_ar unique'),


        ];
    }
}
