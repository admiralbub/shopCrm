<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'phone' => ['required','min:16'],
            'email' => ['required','email','max:255'],
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
            'phone.min' => __('validation_min_title',['attribute'=>__('Phone_title'),'min'=>'16']),

            'email.required' => __('validation_required_title',['attribute'=>__('Email')]),
            'email.email' => __('validation_email_title',['attribute'=>__('Email')]),
            'email.max' => __('validation_max_title',['attribute'=>__('Email'),'max'=>'255']),

        ];
    }
}
