<?php

namespace App\Http\Requests\Dashboard\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:services,title' . ("," . $this->id ?: null) ,
            'price' => 'required|integer',
            'description' => 'sometimes|nullable'
        ];
    }

    public function messages(): array
    {
        return [
          'title.required' => trans("Title"),
          'title.string' => trans("Title"),
          'price.required' => trans("price"),
          'price.integer' => trans("price"),
          'description' => trans("Description"),
        ];
    }
}
