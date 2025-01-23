<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        $role = config('products.role');
        $productId = $this->route('product') ? $this->route('product')->id : null;

        $rules = [
            'name' => 'required|string|min:10',
            'article' => 'required|alpha_num|unique:products',
        ];

        if ($productId) {
            if ($role !== 'admin') {
                unset($rules['article']);
            } else {
                $rules['article'] = 'required|alpha_num|unique:products,article,' . $productId;
            }
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'name.required' => 'Поле "Название продукта" обязательно для заполнения.',
            'name.min' => 'Поле "Название продукта" должно содержать не менее 10 символов.',

            'article.required' => 'Поле "Артикул" обязательно для заполнения.',
            'article.alpha_num' => 'Поле "Артикул" может содержать только латинские буквы и цифры.',
            'article.unique' => 'Поле "Артикул" должно быть уникальным. Такой артикул уже существует.',
        ];
    }
}
