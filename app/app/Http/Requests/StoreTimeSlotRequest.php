<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTimeSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day_from' => 'required|string',
            'day_to' => 'required|string',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i',
            'label' => 'required|string',
            'zone_id' => 'required|exists:zones,id',
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