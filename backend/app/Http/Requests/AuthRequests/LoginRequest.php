<?php

namespace App\Http\Requests\AuthRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone_number'=>'required|string|exists:users,phone_number',
            'password' => 'required|string|min:8',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $customResponse = response()->json([
            'success' => false,
            'message' => 'Invalid Credentials',
            'errors' => $errors,
            'status_message'=>'HTTP_UNPROCESSABLE_ENTITY',
        ],JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        throw new HttpResponseException($customResponse);
    }
}
