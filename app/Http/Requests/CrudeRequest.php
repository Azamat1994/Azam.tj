<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrudeRequest extends FormRequest
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
            'unit_id'   => 'required',
            'quantity'  => 'required',
            'price'     => 'required|numeric',
            'image'     => 'required',
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
            'unit_id'   => 'Единица измерения',
            'quantity'  => 'Количество',
            'price'     => 'Цена',
            'image'     => 'Картинка',
            'is_active' => 'Активно',
        ];
    }
}
