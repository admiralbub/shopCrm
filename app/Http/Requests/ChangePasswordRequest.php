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
            'password' => ['required','min:6','confirmed'],
            'password_confirmation' => ['required','min:6']
        ];
    }

    public function messages(): array
    {
        return [

            'password.required' => __('validation_required_title',['attribute'=>__('Password')]),
            'password.min' => __('validation_min_title',['attribute'=>__('Password'),'min'=>'6']),
            'password.confirmed' => __('validation_confirmed_title',['attribute'=>__('Password')]),

            'password_confirmation.required' => __('validation_required_title',['attribute'=>__('Repeatpassword')]),
            'password_confirmation.min' => __('validation_min_title',['attribute'=>__('Repeatpassword'),'min'=>'6']),

        ];
    }
}
