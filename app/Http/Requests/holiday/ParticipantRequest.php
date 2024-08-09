<?php

namespace App\Http\Requests\holiday;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParticipantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'ids.required' => 'The field "ids" is required.',
            'ids.array' => 'The field "ids" must be an array.',
            'ids.*.required' => 'Every element in the "ids" array is required.',
            'ids.*.exists' => 'Every element in the "ids" array must exist on the users table.',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
