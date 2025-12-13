<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'lastname'  => 'required|string|max:8',
            'firstname' => 'required|string|max:8',
            'gender'    => 'required',
            'email'     => 'required|email',
            'tel1'      => 'required|digits:5',
            'tel2'      => 'required|digits:5',
            'tel3'      => 'required|digits:5',
            'address'   => 'required|string|max:255',
            'building'  => 'nullable|string|max:255',
            'category'  => 'required',
            'message'   => 'required|string|max:120'
        ];
    }

    public function message()
    {
        return [
            'required' => '必須項目です。',
            'email' => 'メールアドレスの形式で入力してください。',
            'digits_between' => '正しい形式で入力してください。'
        ];
    }
}
