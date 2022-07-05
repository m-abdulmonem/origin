<?php

namespace App\Http\Requests\Dashboard\Appearance\Pages;

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
    public function rules() :array
    {
        return [
            'title'  => 'required|unique:pages,title',
            'content' => 'sometimes|nullable',
            'js' => 'sometimes|nullable',
            'css' => 'sometimes|nullable',
            'permalink' => 'sometimes|nullable',
            'status' => 'sometimes|nullable',
            'published_at' => 'sometimes|nullable',
            'featured_image' => 'sometimes|nullable',
            'has_comments' => 'sometimes|nullable',
            'parent' => 'sometimes|nullable',
            'is_reviewed' => 'sometimes|nullable',
            'service_id' => 'sometimes|nullable',
            'password' => 'sometimes|nullable'
        ];
    }


    public function messages() :array
    {
        return [
            'title'  => trans('Title'),
            'content' => trans('Content'),
            'js' => trans('Javascript'),
            'css' => trans('Css'),
            'permalink' => trans('Permalink'),
            'status' => trans('Status'),
            'published_at' => trans('Published At'),
            'featured_image' => trans('Featured image'),
            'has_comments' => trans('Discussion'),
            'parent' => trans('Parent Page'),
            'is_reviewed' => trans('Pending Review'),
            'service_id' => trans("Related Service"),
            'password' => trans('Protected Password')
        ];
    }
}
