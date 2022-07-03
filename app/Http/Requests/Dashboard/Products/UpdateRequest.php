<?php

namespace App\Http\Requests\Dashboard\Products;

use Illuminate\Foundation\Http\FormRequest;


class UpdateRequest extends CreateRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['title']  = 'required|string|unique:products,title,'.$this->route("product")->id;
        return $rules;
    }
}
