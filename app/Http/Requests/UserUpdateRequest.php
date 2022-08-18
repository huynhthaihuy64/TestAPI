<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|unique:users',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => __('messages.email.required'),
            'email.unique' => __('messages.email.unique'),
            'email.email' => __('messages.email.email'),
            'name.required' => __('messages.name.required'),
            'name.unique' => __('messages.name.unique'),
        ];
    }
}
