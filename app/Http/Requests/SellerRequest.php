<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'identity' => 'required|numeric|digits:9|unique:sellers,identity',
            'seller_name' => 'required|min:2|max:60',
            'seller_mobile' => 'required|digits_between:9,10',
            'seller_address' => 'required'
        ];
    }
}