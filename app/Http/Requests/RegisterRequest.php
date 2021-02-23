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
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|regex:/.*[0-9].*/',
            "password_confirmation" => 'required|same:password',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'terms_and_conditions' => 'required'
        ];
    }
}
