<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'name' => [
                'required',
                'max:255',
                'string',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                'unique:subjects',
            ],
            'number_of_credits' => [
                'required',
                'numeric',
                'max:10'
            ],

        ];
    }
}
