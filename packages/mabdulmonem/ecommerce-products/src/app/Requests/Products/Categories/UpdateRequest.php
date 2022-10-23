<?php

namespace Products\Categories;

class UpdateRequest extends CreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        $rules = parent::rules();

        $rules['title'] = 'required|unique:categories,title,'. $this->route("category")->id;

        return $rules;
    }
}
