<?php

namespace App\Http\Requests\Dashboard\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'title' => 'required|string|unique:products,title',
            'description' => 'sometimes|nullable|string',
            'url' => 'sometimes|nullable|string',
            'buy_price'=>'required|integer',
            'sale_price'=>'required|integer',
            'quantity'=>'required|integer',
            'categories'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'title' => \trans("Title"),
            'description' => \trans("Description"),
            'url'=> \trans("Product Url"),
            'buy_price'=> \trans("Buy Price"),
            'sale_price'=> \trans("Sale Price"),
            'quantity'=> \trans("Quantity"),
            'categories'=> \trans("Product categories"),
        ];
    }
}
