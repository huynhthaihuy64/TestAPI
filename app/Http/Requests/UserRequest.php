<?php

namespace App\Http\Requests;

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
            //
            'email' => 'required|email|unique:users',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => __('messages.email.required'),
            'email.unique' => __('messages.email.unique'),
            'email.email' => __('messages.email.email'),
            'password.required' => __('messages.password.required'),
            'password.regex' => __('messages.password.regex'),
        ];
    }
}
