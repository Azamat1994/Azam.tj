<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name'      => 'required',
            'articul'   => 'required',
            'description'   => 'required',
            'size'      => 'required',
            // 'width'   => 'required',
            // 'girth'   => 'required',
            'quantity'  => 'required',
            'image'     => 'required',
            'cost'      => 'required',
//            'markup'    => 'required',
            'crudes'    => 'required',
            'price'     => 'required|numeric',
            'sale'      => 'numeric',
            'color'     => 'numeric',
            'season'    => 'numeric',
            'gender_id'    => '',
            'category_id'    => 'required',
            'is_active' => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'      => 'Название',
            'articul'   => 'Артикуль',
            'description'   => 'Описание',
            'size'   => 'Размер',
            // 'width'   => 'Ширина',
            // 'girth'   => 'Обхват',
            'quantity'  => 'Количество',
            'image'     => 'Картинка',
            'cost'     => 'Себестоимость',
            'markup'     => 'Наценка',
            'sale'     => 'Распродажа',
            'price'     => 'Цена',
            'color'     => 'Цвет',
            'season'     => 'Сезон',
            'gender_id'     => 'Пол',
            'category_id'     => 'Категория',
            'parent_id'     => 'Родитель',
            'is_active' => 'Активно',
        ];
    }
}
