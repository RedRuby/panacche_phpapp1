<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'customer_id' => 'required',
            'collection_id' => 'required',
            'merchandise' => 'required',
            'size_specification' => 'required',
            'product_url' => array("required","regex:".$regex),
            'product_price' => 'required|numeric',
            'quantity' => 'required',
            'vendor_id' => 'nullable|integer',
            'compare_at_price' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'customer id field is required!',
            'collection_id.required' => 'collection id field is required!',
            'merchandise.required' => "Merchandise field is required!",
            'size_specification.required' => 'Size specification field is required!',
            'product_url.required' => "Product url field is required!",
            'product_url.regex' => 'The product url field format is invalid!',
            'product_price.required' => "Product price field is required!",
            'product_price.numeric' => "Product price field is not valid!",
            'quantity' => 'Quantity field is required!',
            'vendor_id.nullable' => 'Vendor field is required!',
            'vendor_id.integer' => 'Vendor field is required!',
            'compare_at_price.required' => "Sale price field is required!",
            'compare_at_price.numeric' => "Sale price field is not valid!",
        ];
    }
}
