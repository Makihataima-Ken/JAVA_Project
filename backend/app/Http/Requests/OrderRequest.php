<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class OrderRequest extends FormRequest
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
            'university' => 'required|string|max:255',
            'major' => 'required|string',
            'type' => 'required|string',
            'description'=>'nullable|string|max:255',
            'deadline'=>'required|string',
            'file_path' => 'nullable|mimes:pdf,doc,docx|max:2048'
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
    /**
     * messages for authentication errors
     */
    public function messages()
    {
        return [
            'university.required'=>'Please provide your university.',
            'major.required'=>'Please provide your major.',
            'type.required' => 'Please provide order type.',
            'deadline.required' => 'deadline is required.',
        ];
    }
}
