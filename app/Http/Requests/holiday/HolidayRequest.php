<?php

namespace App\Http\Requests\holiday;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HolidayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|date_format:Y-m-d',
            'location' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'The description field is required.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'date.required' => 'The date field is required.',
            'date.date_format' => 'The date must be in the format Y-m-d.',
            'location.required' => 'The location field is required.',
            'location.max' => 'The location may not be greater than 255 characters.',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
