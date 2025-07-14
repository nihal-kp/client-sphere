<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\UserStatus;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'phone' => 'required|numeric|digits:10|unique:users,phone,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'required|image|max:2048|dimensions:max_width=500,max_height=500',
            'status' => ['required', Rule::in(array_column(UserStatus::cases(), 'value'))],
        ];
    }

    public function messages(): array
    {
        return [
            'image.dimensions' => 'The image must not exceed 500x500 pixels.',
            'image.max' => 'The image size must not be greater than 2MB.',
        ];
    }
}
