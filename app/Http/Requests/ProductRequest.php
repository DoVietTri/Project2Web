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
            'txtCateName' => 'required',
            'txtProductName'  => 'required|unique:products,name',
            'quantity'  => 'min:1',
            'txtPrice'  => 'required',
            'fImage'  => 'required|image',
            'txtStatus'  => 'required' 
        ];
    }

    public function messages() {
        return [
            'txtCateName.required'  => 'Vui lòng chọn tên danh mục',
            'txtProductName.required'  => 'Vui lòng nhập tên sản phẩm',
            'quantity.min'  => 'Số lượng sản phẩm nhỏ nhất là 1',
            'txtPrice.required'  => 'Vui lòng nhập giá của sản phẩm', 
            'fImage.required'  => 'Vui lòng chọn file', 
            'fImage.image'   => 'File vừa chọn không phải hình ảnh',
            'txtStatus.required'  => 'Vui lòng chọn trạng thái'
        ];
    }
}
