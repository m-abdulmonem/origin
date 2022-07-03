<?php

namespace App\Http\Requests\Dashboard\Appearance\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends CreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() :array
    {
        $rules = parent::rules();

        $rules['title'] = 'required|unique:pages,title,'. $this->route("page")->id;

        return $rules;
    }
}
