<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopOwnerRequest extends FormRequest
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
            'identity' => 'required|numeric|digits:9|unique:shop_owners,identity',
            'owner_name' => 'required|min:2|max:30',
            'owner_mobile' => 'required|numeric|digits_between:9,10',
            'owner_address' => 'required'
        ];
    }
}