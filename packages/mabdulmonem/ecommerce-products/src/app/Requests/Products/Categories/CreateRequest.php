<?php

namespace Products\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [
            'title' => 'required|unique:categories,title',
            'parent' => 'sometimes|nullable|integer',
            'link' => 'sometimes|nullable',
            'description' => 'sometimes|nullable'
        ];
    }

    public function messages():array
    {
        return [
            'title' => trans("Title"),
            'parent' => trans("Subcategory"),
            'link' => trans('Permalink'),
            'description' => trans('Description')
        ];
    }
}
