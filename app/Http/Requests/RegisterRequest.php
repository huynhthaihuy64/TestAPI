<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'email.unique' => "Email already exist",
            'password.required' => 'Please enter your password',
            'password.regex' => 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters'
        ];
    }
}
