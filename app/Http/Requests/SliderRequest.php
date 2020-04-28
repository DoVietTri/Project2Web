<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'txtSlider'  => 'required|unique:sliders,name',
            'fImage'     => 'required|image'
        ];
    }

    public function messages() {
        return [
            'txtSlider.required'   => 'Vui lòng nhập tên slider',
            'txtSlider.unique'     => 'Tên slider đã tồn tại',
            'fImage.required'      => 'Vui lòng upload hình ảnh',
            'fImage.image'         => 'Định dạng file phải là hình ảnh'
        ];
    }
}
