<?php

namespace Corp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo('EDIT_MENU');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->menuTypeCheck()) {
                $validator->errors()->add('memu_type', 'Необходимо выбрать тип меню.');
            }
        });
    }

    protected function menuTypeCheck()
    {
        if ($this->route()->hasParameter('custom_link')
            || $this->route()->hasParameter('category_alias')
            || $this->route()->hasParameter('article_alias')
            || $this->route()->hasParameter('filter_alias')
            || $this->route()->hasParameter('portfolio_alias')) {
            return false;
        }
        return true;
    }
}
