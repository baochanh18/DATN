<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRegisterRequest extends FormRequest
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

    public $validator = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users',
            'username' => 'required|string|min:4|max:15|unique:users|alpha_dash',
            'password' => 'required|string|min:6|confirmed',
            'profile.name' => 'required|string|min:5' ,
            'profile.contact_office_phone' => 'required',
            'profile.company_size' => 'required|min:0|max:9|',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
