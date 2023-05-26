<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class objectpartsstore extends FormRequest
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
            'user_id' => ['required', 'string', 'min:1'],
            'part_id' => ['required', 'string', 'min:1'],
            'daterange' => ['required', 'string', 'min:3', 'max:191'],
            'time' => ['required', 'string', 'min:1', 'max:191'],
            'fot_part' => ['required', 'string', 'min:3', 'max:191'],
            'description' => ['sometimes']
        ];
    }
}