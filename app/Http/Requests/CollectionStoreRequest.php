<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionStoreRequest extends FormRequest
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
            'design_name' => 'required|unique:collections',
            'design_price' => 'required|numeric',
            'room_budget' => 'required|numeric',
            'room_type' => 'required|not_in:0',
            'room_style' => 'required|not_in:0',
            'implementation_guide_description' => 'required',
            'customer_id' => 'required',
            'width_in_feet' => 'required|numeric|min:1|not_in:0',
            'width_in_inches' => 'required|numeric|min:1|not_in:0',
            'height_in_feet' => 'required|numeric|min:1|not_in:0',
            'height_in_inches' => 'required|numeric|min:1|not_in:0',
            'collection_images' => 'required|array|min:1',
            'blue_print_images' => 'required|array|min:1',
          //  'color_img' => 'required|mimes:jpg,jpeg,png,bmp',
            //'color_img' => 'required | mimes:jpeg,jpg,png | max:1000',
            'color_name.*' => 'required',
            'brand.*' => 'required',
            'finish.*' => 'required',
            'application.*' => 'required',
            'design_implementation_guide' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'design_name.required' => 'Design_name field is required!',
            'design_name.unique' => 'Design name has already been taken',
            'design_price.required' => 'Design price field is required!',
            'design_price.numeric' => 'Design price is not valid!',
            'room_budget.required' => "Room budget field is required!",
            'room_budget.numeric' => "Room budget is not valid!",
            'room_type.required' => 'Room type field is required!',
            'room_type.not_in:0' => 'Room type field is not valid!',
            'room_style.required' => "Room style field is required!",
            'room_style.not_in:0' => 'Room style field is not valid!',
            'implementation_guide_description.required' => "Design description is required!",
            'width_in_feet.required' => 'Width in feet field is required!',
            'width_in_feet.numeric' => 'Width in feet is not valid!',
            'width_in_feet.min' => 'Width in feet is not valid!',
            'width_in_feet.not_in' => 'Width in feet is not valid!',
            'width_in_inches.required' => 'Width in inches field is required!',
            'width_in_inches.numeric' => 'Width in inches is not valid!',
            'width_in_inches.min' => 'Width in inches is not valid!',
            'width_in_inches.not_in' => 'Width in inches is not valid!',
            'height_in_feet.required' => 'Height in feet field is required!',
            'height_in_feet.numeric' => 'Height in feet is not valid!',
            'height_in_feet.min' => 'Height in feet is not valid!',
            'height_in_feet.not_in' => 'Height in feet is not valid!',
            'height_in_inches.required' => 'Height in inches field is required!',
            'height_in_inches.numeric' => 'Height in inches is not valid!',
            'height_in_inches.min' => 'Height in inches is not valid!',
            'height_in_inches.not_in' => 'Height in inches is not valid!',
            'color_img' => 'Color image is required!',
            'color_name' => 'Color name field is required!',
            'brand' => 'Brand field is  required!',
            'finish' => 'Finish field is required!',
            'application' => 'Application field is required!',
        ];
    }
}
