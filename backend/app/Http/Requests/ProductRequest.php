<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Auth::user()->user_type!='admin'){
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file_path' => 'nullable|mimes:pdf,doc,docx|max:10240'
        ];
    }

    /**
     * failed validation response
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $customResponse = response()->json([
            'success' => false,
            'message' => 'missing information',
            'errors' => $errors,
            'status_message'=>'HTTP_BAD_REQUEST',
        ],JsonResponse::HTTP_BAD_REQUEST);

        throw new HttpResponseException($customResponse);
    }
}
