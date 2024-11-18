<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'first_name' => ['required','string','max:255'],
            'last_name' =>  ['required','string','max:255'],
            'middle_name' =>  ['nullable'],

           
            'phone' => ['required','min:16'],
            'email' => ['required','email','max:255'],
            'deliver' =>  ['required'],
            'pay' =>  ['required'],

            'city_np' =>  ['nullable'],

            'city_ref_np' =>  ['nullable'],

            'warehouse_np' =>  ['nullable'],

            'warehouse_ref_np' =>  ['nullable'],
            'notes_order' =>  ['nullable'],
            

        ];
    }
}
