<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CvRequest extends FormRequest
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
            'id_user' => 'required',
            'date' => 'required',
            'file' => 'required',
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
            'file.required' => __('messages.file.required'),
            'date.required' => __('messages.date.required'),
            'id_user.required' => __('messages.id_user.required'),
        ];
    }
}
