<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjectsStore extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:191'],
            'code' => ['required', 'string', 'min:1', 'max:100'],
            'daterange' => ['required', 'string', 'min:3', 'max:191'],
            'user_id' => ['required', 'string', 'min:1'],
            'stage_id' => ['required', 'string', 'min:1'],
            'project_sum' => ['required', 'string', 'min:3', 'max:191'],
            'plan_fot' => ['required', 'string', 'min:3', 'max:191'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['sometimes']
        ];
    }
}
