<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sku'                => 'required|alpha_num|min:8|max:12',
            'name'               => 'required|string|max:50',
            'store_id'           => 'required|integer',
            'inventory_quantity' => 'required|integer',
        ];
    }

    /**
     * Returns the error message for store requests
     *
     * @param \Illuminate\Contracts\Validation\Validator $mValidator
     * @return void
     */
    protected function failedValidation(Validator $mValidator)
    {
        throw new HttpResponseException(response()->json(
            [
                'errors' => $mValidator->errors(),
                'code'   => 422,
            ],
            422
        ));
    }
}
