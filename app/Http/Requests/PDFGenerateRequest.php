<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class PDFGenerateRequest extends FormRequest
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
            "html" => "required|string",
            "width" => "integer",
            "height" => "integer",
            "css" => "nullable|string",
            "name" => "required|string",
            "token" => [
                'required',
                Rule::in([env('PDF_TOKEN')]),
            ],
            "type" =>  [
                'required',
                Rule::in(['file', 'base64']),
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
            "html.required" => "html is required",
            "html.string" => "html should be a string",
            "name.required" => "name is required",
            "name.string" => "name should be a string",
            "css.string" => "css should be a string",
            "token.required" => "token is required",
            "token.in" => "token is not valid",
            "type.required" => "type is required",
            "type.in" => "type should be file or base64",
        ];
    }

}
