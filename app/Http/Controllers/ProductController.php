<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\ProductImage;
use File;
use Request;

class ProductController extends Controller
{
	public function getList() {
		$product = Product::orderBy('id', 'DESC')->paginate(10);
		return view('admin.pages.product.list', compact('product'));
	}
    public function getAdd() {
    	$category = Category::select('id', 'name')->orderBy('id', 'DESC')->get();
    	return view('admin.pages.product.add', compact('category'));
    }

    public function postAdd(ProductRequest $request) {
    	$product = new Product;

    	$img_name = $request->file('fImage')->getClientOriginalName();

    	$product->name = $request->txtProductName;
    	$product->alias = changeTitle($request->txtProductName);
    	$product->quantity = $request->nquantity;
    	$product->price = $request->txtPrice;
    	$product->promotional = $request->txtPromotional;
    	$product->description = $request->txtDescription;
    	$product->image = $img_name;
    	$product->status = $request->txtStatus;
    	$product->category_id  = $request->txtCateName;
    	$request->file('fImage')->move('resources/upload/', $img_name);

    	$product->save();

    	$p_id  = $product->id;

    	if ($request->hasFile('fImageDetail')) {
    		foreach ($request->file('fImageDetail') as $file) {
    			$product_img = new ProductImage;

    			if(isset($file)) {
    				$product_img->image  = $file->getClientOriginalName();
    				$product_img->product_id     = $p_id;
    				$file->move('resources/upload/detail/', $file->getClientOriginalName());
    				$product_img->save(); 
    			}
    		}
    	}
    	return redirect()->route('admin.product.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Thêm sản phẩm thành công']);
    }

    public function getDelete($id) {
    	$product = Product::find($id);
    	$product_img = Product::find($id)->pimages;
    	
    	foreach($product_img as $item) {
    		File::delete('resources/upload/detail/'.$item['image']);
    	}

    	File::delete('resources/upload/'.$product->image);

    	$product->delete();

    	return redirect()->route('admin.product.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Xóa sản phẩm thành công']);
    }

    public function getEdit($id) {
    	$product = Product::find($id);
    	$product_img = Product::find($id)->pimages;
    	$cate = Product::find($id)->category;
    	$cate_detail = Category::orderBy('id', 'DESC')->get();
    	return view('admin.pages.product.edit', compact('product', 'product_img', 'cate', 'cate_detail'));
    }

    public function postEdit(Request $request, $id) {
    	$product = Product::find($id);

    	$this->validate($request, [
    		'txtProductName'  => 'required|unique:products,name',
    		'nquantity'   => 'required',
    		'txtPrice'    => 'required|numeric',
    		'txtPromotional'  => 'numeric',
    		'fImage'   => 'image',
    		'fImageDetail'  => 'image',
    		'txtStatus'   => 'required'
    	], [
    		'txtProductName.required'  => 'Vui lòng nhập tên sản phẩm',
    		'txtProductName.unique'    => 'Tên sản phẩm đã tồn tại', 
    		'nquantity.required'  => 'Vui lòng nhập số lượng', 
    		'txtPrice.required'   => 'Vui lòng nhập giá sản phẩm',
    		'txtPrice.numeric'    => 'Giá sản phẩm phải là kiểu số',
    		'txtPromotional.numeric'  => 'Giá khuyến mại phải là kiểu số',
    		'fImage.image'   => 'File ảnh đại diện nhập vào không đúng định dạng',
    		'fImageDetail.image'   => 'File ảnh detail nhập vào không đúng định dạng',
    		'txtStatus.required'   => 'Vui lòng nhập trạng thái'  
    	]);

		

		$check = request('fImage');
        $image_current = 'resources/upload/'.Request::input('img_current');

        if ($check) {
            $file_name = $request->file('fImage')->getClientOriginalName();
            $product->image = $file_name;
            $request->file('fImage')->move('resources/upload/', $file_name);
            if (File::exists($image_current)) {
                File::delete($image_current);
            }
        }
        $product->name = $request->txtProductName;
        $product->alias = changeTitle($request->txtProductName);
        $product->price = $request->txtPrice;
        $product->promotional = $request->txtPromotional;
        $product->quantity = $request->nquantity;
        $product->description = $request->txtDescription;
        $product->status   = $request->txtStatus;

        $product->save();

        if (!empty(Request::file('fImageDetail'))) {
            foreach (Request::file('fImageDetail') as $file) {
                $product_img = new ProductImage;
                if (isset($file)) {
                    $product_img->image = $file->getClientOriginalName();
                    $product_img->product_id = $id;
                    $request->file('fImageDetail')->move('resources/upload/detail/', $file->getClientOriginalName());
                    $product_img->save();
                }
            }

        }

        return redirect()->route('admin.product.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Sửa sản phẩm thành công']);
	}

    public function getDelImg($id) {

    	if (Request::ajax()) {
            $idHinh = (int) Request::get('id');
            $image_detail = ProductImage::find($idHinh);

            if (!empty($image)) {
                $img = 'resources/upload/detail/'.$image_detail->image;
                
                if (File::exists($img)) {
                    File::delete($img);
                }

                $image_detail->delete();
            }
            return "Oke";
        }
    }	

}
