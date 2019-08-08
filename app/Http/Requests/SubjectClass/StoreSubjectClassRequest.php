<?php

namespace App\Http\Requests\SubjectClass;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectClassRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'max:255',
                'unique:subject_classes',
            ],
            'subject_id' => [
                'numeric',
                'required',
            ]
        ];
    }
}
