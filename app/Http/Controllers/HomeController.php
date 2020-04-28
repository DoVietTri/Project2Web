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

class HomeController extends Controller
{

	public function index() {
		$cate = Category::orderBy('id', 'DESC')->get();
		$product = DB::table('products')->orderBy('id', 'DESC')->get();
		$product_new = DB::table('products')->orderBy('id', 'DESC')->skip(0)->take(3)->get();
		$slider = DB::table('sliders')->orderBy('id', 'DESC')->skip(0)->take(3)->get();
		return view('client.pages.index', compact('product', 'product_new', 'slider'));
	}

	public function getSingle($id) {
		$product = DB::table('products')->where('id', $id)->first();
		$product_img = DB::table('product_images')->select('id', 'image')->where('product_id', $id)->get();
		$cate = Product::find($id)->category;
		return view('client.pages.single', compact('product', 'product_img', 'cate'));
	}

	public function getCategory($id) {
		$product = DB::table('products')->where('category_id', $id)->orderBy('id', 'DESC')->paginate(2);
		return view('client.pages.category', compact('product', 'cate'));
	}
}
