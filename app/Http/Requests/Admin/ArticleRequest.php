<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'content_html' => 'required',
          //'tags' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
        ];
    }
    /**
     * 字段名称

     * @date   2016-11-02T10:28:52+0800
     * @return [type]                   [description]
     */
    public function attributes()
    {
        return [
            'category_id'   => trans('admin/article.model.category'),
            'title'         => trans('admin/article.model.title'),
            'author'        => trans('admin/article.model.author'),
            'content_html'  => trans('admin/article.model.content_html'),
            'content_mark'  => trans('admin/article.model.content_mark'),
            'tags'          => trans('admin/article.tags'),
        ];
    }
}
