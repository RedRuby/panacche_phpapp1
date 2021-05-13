<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shop' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required',
            'phone' => 'required',
            'how_did_you_hear_about_us' => 'required',
            'customer' =>'required'
        ];
    }

    public function messages()
    {
        return [
            'shop.required' => 'Shop name is required!',
            'first_name.required' => 'First name is required!',
            'first_name.string' => "First name should be valid!",
            'last_name.required' => 'Last name is required!',
            'last_name.string' => "Last name should be valid!",
            'email.required' => 'Email is required!',
            'email.unique' => 'Email has already taken!',
            'phone.required' => "Contact number field is required!",
            'how_did_you_hear_about_us.required' => "How did you hear about us is required!",
            'customer.required' => 'Customer id is required'
        ];
    }
}
