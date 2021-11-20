<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'client_id'      => 'required',
            'total'   => 'required',
            'status_id'   => 'required',
            'delivery_id'   => '',
            'address' => '',
            'city' => '',
            'phone' => '',
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
            'client_id'      => 'Клиент',
            'total'   => 'Итог',
            'status_id'   => 'Статус',
            'delivery_id'   => 'Доставка',
        ];
    }
}
