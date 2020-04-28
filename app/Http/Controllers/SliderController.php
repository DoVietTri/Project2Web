<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Http\Requests\SliderRequest;
use File;
class SliderController extends Controller
{
	public function getList() {
		$slider = Slider::orderBy('id', 'DESC')->get();
		return view('admin.pages.slider.list', compact('slider'));
	}
    public function getAdd() {
    	return view('admin.pages.slider.add');
    }

    public function postAdd(SliderRequest $request) {
    	$slider = new Slider;

    	$img_name = $request->file('fImage')->getClientOriginalName();
    	$slider->name = $request->txtSlider;
    	$slider->alias = changeTitle($request->txtSlider);
    	$slider->image = $img_name;
    	$request->file('fImage')->move('resources/upload/slider/', $img_name);
    	$slider->save();
    	return redirect()->route('admin.slider.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Thêm slider thành công']);
    }

    public function getDelete($id) {
    	$slider = Slider::find($id);
    	File::delete('resources/upload/slider/'.$slider->image);
    	$slider->delete();
    	return redirect()->route('admin.slider.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Xóa slider thành công']);
    }

    public function getEdit($id) {
    	$slider = Slider::find($id);
    	return view('admin.pages.slider.edit', compact('slider'));
    }

    public function postEdit(Request $request, $id) {
    	$this->validate($request, [
    		'txtSlider'   => 'required',
    		'fImage'      => 'image'
    	], [
    		'txtSlider.required'   => 'Vui lòng nhập tên slider',
    		'fImage.image'      => 'Định dạng file phải là hình ảnh'
    	]);
    	$slider = Slider::find($id);

	 	$slider->name = $request->txtSlider;
	 	$slider->alias = changeTitle($request->txtSlider);

	 	$check = request('fImage');

	 	if ($check) {
	 		File::delete('resources/upload/slider/'.$slider->image);
	 		$img_name = $request->file('fImage')->getClientOriginalName();
	 		$slider->image = $img_name;
	 		$request->file('fImage')->move('resources/upload/slider/', $img_name);
	 		$slider->save();
	 	} else {
	 		$slider->save();
	 	}

	 	return redirect()->route('admin.slider.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Sửa slider thành công']);
    }

}
