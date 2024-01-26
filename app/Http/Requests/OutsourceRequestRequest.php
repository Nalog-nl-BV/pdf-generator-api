<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class OutsourceRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "fileName" => "required|string",
            "date" => "required|string",
            "number" => "required|string",
            "accountant_name" => "required|string",
            "comment" => "string",
            "orders" => "required|array",
            "token" => [
                'required',
                Rule::in([env('PDF_TOKEN')]),
            ],
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code'   => 400,
            'status'   => "error",
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
