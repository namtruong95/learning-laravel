<?php

namespace App\Http\Requests\ClassRoom;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRoomRequest extends FormRequest
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
                'string',
                'max:255'
            ],
            'code' => [
                'required',
                'string',
                'unique:class_rooms'
            ]
        ];
    }
}
