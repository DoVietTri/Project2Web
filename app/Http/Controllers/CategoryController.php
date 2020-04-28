<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;
use Validator;

class CategoryController extends Controller
{
	public function getList() {
		$category = Category::orderBy('id', 'DESC')->paginate(5);
		return view('admin.pages.category.list', compact('category'));
	}

    public function getAdd() {
    	return view('admin.pages.category.add');
    }

    public function postAdd(CategoryRequest $request) {
    	$category = new Category;

    	$category->name = $request->txtCateName;
    	$category->alias = changeTitle($request->txtCateName);
    	$category->save();
   		return redirect()->route('admin.category.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Thêm danh mục thành công']);
    }

    public function getDelete($id) {
    	$category = Category::find($id);
    	$category->delete();
    	return redirect()->route('admin.category.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Xóa danh mục thành công']);
    }

    public function getEdit($id) {
    	$category = Category::find($id);
    	return view('admin.pages.category.edit', compact('category'));
    } 

    public function postEdit(Request $request, $id) {
    	$category = Category::find($id);
    	$this->validate($request, [
    			'txtCateName' => 'required'
    		],[
    			'txtCateName.required' => 'Vui lòng nhập tên danh mục'
    	]);

    	$category->name = $request->txtCateName;
    	$category->alias = changeTitle($request->txtCateName);
    	$category->save();

    	return redirect()->route('admin.category.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Sửa danh mục thành công']);
    }

}
