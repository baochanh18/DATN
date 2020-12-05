<?php

namespace App\Rules\API;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class BenefitJSONString implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $parsed_data = \GuzzleHttp\json_decode($value, true);
            if(!Arr::has($parsed_data, 'benefits_description')) return false;
            if(empty($parsed_data['benefits_description'])) return false;
        }
        catch (\Exception $exception)
        {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute không hợp lệ! Vui lòng kiểm tra lại.';
    }
}
