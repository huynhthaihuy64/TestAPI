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
            'name' => 'required',
            'email' => 'required|unique:cvs',
            'phone' => 'required|numeric',
            'position' => 'required',
            'file' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is exist',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be a number',
            'file.required' => 'File is required',
        ];
    }
}
