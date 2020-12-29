<?php

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientStoreRequest extends FormRequest
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
                'max:255'
            ],
            'date_of_birth' => [
                'required',
                'date_format:d/m/Y'
            ],
            'gender' => [
                'required',
                Rule::in(GenderEnum::getAllValues())
            ],
            'zip_code' => [
                'max:9',
                'nullable'
            ],
            'address' => [
                'max:255',
                'nullable'
            ],
            'number' => [
                'max:20',
                'nullable'
            ],
            'complement' => [
                'max:100',
                'nullable'
            ],
            'neighborhood' => [
                'max:255',
                'nullable'
            ],
            'city_id' => [
                'exists:cities,id',
                'nullable'
            ]
        ];
    }
}
