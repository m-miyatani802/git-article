<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'birth'       => 'date',
            'birth_year'  => 'required_with:birth_month,birth_day',
            'birth_month' => 'required_with:birth_year,birth_day',
            'birth_day'   => 'required_with:birth_year,birth_month',
        ];
    }

    public function getValidatorInstance()
    {
        if ($this->input('birth_day') && $this->input('birth_month') && $this->input('birth_year'))
        {
            $birthDate = implode('-', $this->only(['birth_year', 'birth_month', 'birth_day']));
            $this->merge([
                'birth' => $birthDate,
            ]);
        }

        return parent::getValidatorInstance();
    }
}
