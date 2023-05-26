<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class partuserupdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'object_parts_id' => ['required', 'string', 'min:1', 'max:191'],
            'date' => ['required', 'string', 'min:3', 'max:100'],
            'time' => ['required', 'string', 'min:1', 'max:100'],
            'description' => ['sometimes'],
        ];
    }
}