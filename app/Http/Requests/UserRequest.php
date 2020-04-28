<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'txtUsername'   => 'required',
            'txtEmail'     => 'required|unique:users,email',
            'txtPass'      => 'required',
            'txtSamePass'  => 'same:txtPass'
        ];
    }

    public function messages() {
        return [
            'txtUsername.required'   => 'Bạn chưa nhập tên',
            'txtEmail.required'     => 'Bạn chưa nhập email',
            'txtEmail.unique'      => 'Email đã tồn tại',
            'txtPass.required'     => 'Bạn chưa nhập mật khẩu',
            'txtSamePass.same'  => 'Mật khẩu phải trùng nhau'
        ];
    }
}
