<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmPassword' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'oldpassword.required'=>'Old password is required',
            'newpassword.required'=> 'New Password is required',
            'newpassword.min'=> 'Your New Password must be at least 8 characters',
            'confirmPassword.required'=> 'confirm Password is required'
        ];
    }

}
