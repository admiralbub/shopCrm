<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'first_name' => ['required','string','max:255'],
            'last_name' =>  ['required','string','max:255'],
            'middle_name' =>  ['nullable'],
            'phone' => ['required','unique:users,phone','min:16'],
            'email' => ['required','email','unique:users,email','max:255'],
            'password' => ['required','min:6','confirmed'],
            'password_confirmation' => ['required','min:6']
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => __('validation_required_title',['attribute'=>__('firstName_title')]),
            'first_name.string' => __('validation_string_title',['attribute'=>__('firstName_title')]),
            'first_name.max' => __('validation_max_title',['attribute'=>__('firstName_title'),'max'=>'255']),
            'last_name.required' => __('validation_required_title',['attribute'=>__('lastName_title')]),
            'last_name.string' => __('validation_string_title',['attribute'=>__('lastName_title')]),
            'last_name.max' => __('validation_max_title',['attribute'=>__('lastName_title'),'max'=>'255']),
           
            
            'phone.required' => __('validation_required_title',['attribute'=>__('Phone_title')]),
            'phone.unique' => __('validation_unique_title',['attribute'=>__('Phone_title')]),
            'phone.min' => __('validation_min_title',['attribute'=>__('Phone_title'),'min'=>'16']),

            'email.required' => __('validation_required_title',['attribute'=>__('Email')]),
            'email.unique' => __('validation_unique_title',['attribute'=>__('Email')]),
            'email.email' => __('validation_email_title',['attribute'=>__('Email')]),
            'email.max' => __('validation_max_title',['attribute'=>__('Email'),'max'=>'255']),

            'password.required' => __('validation_required_title',['attribute'=>__('Password')]),
            'password.min' => __('validation_min_title',['attribute'=>__('Password'),'min'=>'6']),
            'password.confirmed' => __('validation_confirmed_title',['attribute'=>__('Password')]),

            'password_confirmation.required' => __('validation_required_title',['attribute'=>__('Repeatpassword')]),
            'password_confirmation.min' => __('validation_min_title',['attribute'=>__('Repeatpassword'),'min'=>'6']),

        ];
    }
}
