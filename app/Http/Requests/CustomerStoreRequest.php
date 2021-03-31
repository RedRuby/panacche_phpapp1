<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'email' => 'required|unique:customers',
            'phone' => array('required', 'regex:/^(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([0-9]{3})\s*\)|([0-9]{3}))\s*(?:[.-]\s*)?([0-9]{3})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'),
            'how_did_you_hear_about_us' => 'required',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
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
            'phone.required' => "Phone is required!",
            'phone.regex' => 'Phone must be valid!',
            'how_did_you_hear_about_us.required' => "How did you hear about us is required!",
            'password.required' => 'Password is required!',
            'confirm_password.required' => 'Confirm password is required!',
            'confirm_password.same' => 'Confirm password should match with password!',
        ];
    }
}
