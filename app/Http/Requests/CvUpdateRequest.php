<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CvUpdateRequest extends FormRequest
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
            'name' => 'required|unique:cvs',
            'email' => 'required|unique:cvs',
            'phone' => 'required|numeric',
            'position' => 'required',
            'active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.name.required'),
            'name.unique' => __('messages.name.unique'),
            'email.required' => __('messages.email.required'),
            'email.unique' => __('messages.email.unique'),
            'phone.required' => __('messages.phone.required'),
            'phone.numeric' => __('messages.phone.numeric'),
            'position.required' => __('messages.position.required'),
            'active.required' => __('messages.active.required'),
        ];
    }
}
