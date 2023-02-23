<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class PDFDeleteRequest extends FormRequest
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
            "delete_all" => "required|boolean",
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

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            "delete_all.required" => "delete_all flag is required",
            "delete_all.boolean" => "delete_all should be true or false",
            "token.required" => "token is required",
            "token.in" => "token is not valid",
        ];
    }

}
