<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:users',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('messages.email.required'),
            'email.email' => __('messages.email.email'),
            'email.exists' => __('messages.email.exists'),
            'password.required' => __('messages.password.required'),
            'password.confirmed' => __('messages.password.confirmed'),
            'password.regex' => __('messages.email.regex'),
        ];
    }
}
