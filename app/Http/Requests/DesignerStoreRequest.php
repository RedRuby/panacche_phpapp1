<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignerStoreRequest extends FormRequest
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
        $regex = "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/";
        return [
            'shop' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:customers',
            'phone' => array('required', 'regex:/^(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([0-9]{3})\s*\)|([0-9]{3}))\s*(?:[.-]\s*)?([0-9]{3})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'),
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'website_url' => array("nullable","regex:".$regex),
            'resume' => 'required',
            'portfolio' => 'required'
        ];
    }

    public function messages()
    {

        return [
            'shop.required' => 'Shop name field is required!',
            'first_name.required' => 'First name field is required!',
            'first_name.string' => "First name field should be valid!",
            'last_name.required' => 'Last name field is required!',
            'last_name.string' => "Last name field should be valid!",
            'email.required' => 'Email field is required!',
            'email.unique' => 'Email has already been taken!',
            'phone.required' => "Contact number field is required!",
            'phone.regex' => 'Contact number must be valid!',
            'password.required' => 'Password field is required!',
            'confirm_password.required' => 'Confirm password field is required!',
            'confirm_password.same' => 'Confirm password field should match with password field!',
            'website_url.regex' => 'The website url field format is invalid!'
        ];
    }
}
