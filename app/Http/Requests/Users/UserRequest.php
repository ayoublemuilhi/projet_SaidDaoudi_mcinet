<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'password' => 'required|same:confirm-password|min:8',
            'status' => 'required',
            'roles' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('users.utilisateur required'),
            'name.max' => __('users.utilisateur max'),

            'email.required' => __('users.utilisateur_email required'),
            'email.email' => __('users.utilisateur_email_valid'),
            'email.unique' => __('users.utilisateur unique'),
            'email.max' => __('users.utilisateur_email_max max'),


            'password.required' => __('users.utilisateur_password required'),
            'password.same' => __('users.utilisateur_confirm_password'),
            'password.min' => __('users.utilisateur_min'),

            'status.required' => __('users.utilisateur_status required'),
            'roles.required' => __('users.utilisateur_role required'),

        ];
    }
}
