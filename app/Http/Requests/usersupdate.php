<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class usersupdate extends FormRequest
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
            'fio' => ['required', 'string', 'min:3', 'max:191'],
            'email' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['sometimes'],
            'password' => ['required', 'string', 'min:6', 'max:191'],
            'rule_id' => ['required', 'string', 'min:1', 'max:191'],
            'special_id' => ['required', 'string', 'min:1', 'max:191'],
            'parts' => ['required', 'array', 'min:1', 'max:191'],
            'oklad' => ['required', 'string', 'min:3', 'max:191'],
        ];
    }
}