<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'city'      => 'required',
            'address'   => 'required',
            'phone'     => 'required',
            'email'     => 'required',
            'picture'   => '',
            'link'      => 'required',
            'is_active' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'      => 'Название',
            'city'      => 'Город',
            'address'   => 'Адрес',
            'phone'     => 'Номер телефона',
            'email'     => 'Почтовый адрес',
            'picture'   => 'Картинка',
            'link'      => 'ссылка на адрес',
            'is_active' => 'Активно',
        ];
    }
}
