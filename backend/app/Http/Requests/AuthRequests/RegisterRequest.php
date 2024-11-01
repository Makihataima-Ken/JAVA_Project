<?php

namespace App\Http\Requests\AuthRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class RegisterRequest extends FormRequest
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
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone_number'=>'required|string|min:10|max:10|unique:users,phone',
            'password' => 'required|string|confirmed|min:8',
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
            'message' => 'Invalid Credentials',
            'errors' => $errors,
            'status_message'=>'HTTP_BAD_REQUEST',
        ],JsonResponse::HTTP_BAD_REQUEST);

        throw new HttpResponseException($customResponse);
    }
    /**
     * messages for authentication errors
     */
    public function messages()
    {
        return [
            'first_name.required'=>'Please provide your first name.',
            'last_name.required'=>'Please provide your last name.',
            'phone_number.required' => 'Please provide your phone number.',
            'password.required' => 'Your password is required.',
        ];
    }
}

