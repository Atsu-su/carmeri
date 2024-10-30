<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'postal_code' => 'required|regex:/^d{3}-d{4}$/',
            'address' => 'required|string|max:100',
            'building_name' => 'nullable|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '名前は50文字以内で入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => '郵便番号はXXX-XXXX（ハイフンあり）の形式で入力してください',
            'address.required' => '住所を入力してください',
            'address.max' => '住所は100文字以内で入力してください',
            'building_name.max' => '建物名は100文字以内で入力してください',
        ];
    }
}
