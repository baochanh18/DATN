<?php

namespace App\Http\Requests;

use App\Rules\API\AddressJSONString;
use App\Rules\API\BenefitJSONString;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
        $rules = [
            'job_title' => 'required|string|min:4',
            'company_name' => 'required|string|min:4',
            'address' => 'required|string|min:4',
            'company_descriptions' => 'required|string|min:4',
            'company_size' => 'required|numeric|min:0|max:9',
            'job_level' => 'required|numeric|min:0|max:3',
            'job_type' => 'required|numeric|min:0|max:5',
            'job_salary_type' => 'required|numeric|min:0|max:1',
            'job_minimum_salary' => 'required|numeric|min:0|max:10000',
            'job_maximum_salary' => 'required|numeric|min:0|max:10000',
            'job_description' => 'required|string|min:4',
            'job_requirement' => 'required|string|min:4',
            'cv_language' => 'required|string|min:4',
            'job_categories' => 'required|array|min:1|max:3',
            'job_categories.*' => 'required|numeric|min:1',
            'benefits' => 'required|array|min:1|max:3',
            'addresses' => 'required|array|min:1|max:3',
            'addresses.*' => new AddressJSONString(),
            'benefits.*' => new BenefitJSONString() ,
            'company_logo' => 'mimes:jpeg,jpg,png|max:1024',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
