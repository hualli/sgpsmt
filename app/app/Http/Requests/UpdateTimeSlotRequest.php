<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTimeSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day_from' => 'sometimes|required|string',
            'day_to' => 'sometimes|required|string',
            'time_from' => 'sometimes|required|date_format:H:i',
            'time_to' => 'sometimes|required|date_format:H:i',
            'label' => 'sometimes|required|string',
            'zone_id' => 'sometimes|required|exists:zones,id',
        ];
    }
    /**
     * Handles the failure of a request validation
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator  contains the validation errors
     * @throws \Illuminate\Http\Exceptions\HttpResponseException  throws an exception with validation errors
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
            ]
        ));
    }
}