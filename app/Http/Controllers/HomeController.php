<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Category;
use DB;
use View;
use App\Product;
use App\Slider;
// use App\Mail\ShoppingMail;
// use Illuminate\Support\Facades\Mail;
use App\Order;
use App\OrderDetail;
use Mail;

class HomeController extends Controller
{

	public function index() {
		// \Session::flash('toastr', [
		// 	'type' => 'error',
		// 	'message' => 'Thành công'
		// ]);
		//Mail::to('tri.dv270999@gmail.com')->send(new ShoppingMail());

		$cate = Category::orderBy('id', 'DESC')->get();
		$product = DB::table('products')->orderBy('id', 'DESC')->get();
		$product_new = DB::table('products')->orderBy('id', 'DESC')->skip(0)->take(3)->get();
		$product_selling = DB::table('products')->orderBy('product_pay', 'DESC')->skip(0)->take(3)->get();
		$slider = DB::table('sliders')->orderBy('id', 'DESC')->skip(0)->take(3)->get();
		return view('client.pages.index', compact('product', 'product_new', 'slider', 'product_selling'));
	}

	public function getSingle($id) {
		$product = DB::table('products')->where('id', $id)->first();
		$product_img = DB::table('product_images')->select('id', 'image')->where('product_id', $id)->get();
		$product_selling = DB::table('products')->orderBy('product_pay', 'DESC')->skip(0)->take(3)->get();
		$product_relate = DB::table('products')->where('category_id', $product->category_id)->orderBy('id', 'DESC')->get();
		$cate = Product::find($id)->category;
		return view('client.pages.single', compact('product', 'product_img', 'cate','product_selling', 'product_relate'));
	}

	public function getCategory($id) {
		$cate = Category::find($id);
		$product = DB::table('products')->where('category_id', $id)->orderBy('id', 'DESC')->paginate(2);
		return view('client.pages.category', compact('product', 'cate'));
	}

	public function getSearch(Request $request) {
		$product = Product::where('name', 'like','%'.$request->txtNameProduct.'%')->get();

		return view('client.pages.search', compact('product'));
	}

	public function getMyListOrder() {
		if (Auth::check()) {
			$order = Order::where('user_id', Auth::user()->id)->orderBy('status', 'ASC')->get();
			return view('client.pages.myorder', compact('order'));
		} else {
			return redirect()->route('index');
		}

	}

	public function getMyOrderDetail(Request $request, $id) {
		if ($request->ajax()) {

			$orders = OrderDetail::with('product')->where('order_id', $id)->get();
            $html = view('client.pages.myorderdetail', compact('orders'))->render();
            
            return response(['html' => $html]);
		}
	}

}
