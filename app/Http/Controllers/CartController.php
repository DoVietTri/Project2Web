<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;
use Auth;
use App\Order;
use App\OrderDetail;
use App\Customer;
use Session;
use Mail;
use App\Mail\ShoppingMail;
class CartController extends Controller
{
	public function getCart() {
		$content = Cart::content();
		$subtotal = Cart::subtotal(0, ",", ".");
		return view('client.pages.cart', compact('content', 'subtotal'));
	}
    
    public function addCart($id, Request $req) {
    	$product = Product::find($id);

        $val = $req->qty;
    	if ($val) {
    		$qty = $val;
    	} else {
    		$qty = 1;
    	}
        if ($qty > $product->quantity) {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Sản phẩm đã hết hàng'
            ]);
            return redirect()->back();
        }

    	if ($product->promotional > 0) {
    		$price = $product->promotional;
    	} else {
    		$price = $product->price;
    	}

    	$cart = ['id' => $id, 'name' => $product->name,'qty' => $qty, 'price' => $price, 'weight' => 0, 'options' => ['img' => $product->image]];
		
        if (Cart::add($cart)) {
            \Session::flash('toastr', [
                'type' => 'success',
                'message' => 'Thêm sản phẩm vào giỏ thành công !'
            ]);
            return redirect()->back();
        } else {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Thêm sản phẩm vào giỏ không thành công !'
            ]);
            return redirect()->back();
        }	
    }

    public function updateCart(Request $request, $id) {
        if ($request->ajax()) {
            $id = $request->id;
            $qty = $request->qty;
            Cart::update($id, $qty);
            echo "oke";
        }
    }

    public function deleteCart(Request $request, $id) {
        if ($request->ajax()) {
            $id = $request->id;
            Cart::remove($id);
            echo "oke";
        }
    }

    public function getCheckout() {

        $item = Cart::count();

        if ($item == 0) { 
             \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Giỏ hàng chưa có sản phẩm !'
            ]);
            return redirect()->back();
        } else {
            $user = Auth::user();
            $content = Cart::content(); 
            $price_total = Cart::subtotal();
            return view('client.pages.checkout', compact('content', 'user', 'price_total'));
        }    
    }

    public function postCheckout(Request $request) {
        $this->validate($request, 
        [
            'txtUsername'  => 'required',
            'txtEmail'   => 'required|email',
            'txtAddress' => 'required',
            'txtPhone'   => 'required'

        ], [
            'txtUsername.required'   => 'Vui lòng nhập tên tài khoản',
            'txtEmail.required'     => 'Vui lòng nhập email',
            'txtAddress.required'   => 'Vui lòng nhập địa chỉ nhận hàng',
            'txtPhone.required'     => 'Vui lòng nhập số điện thoại' 
        ]);

       $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name  = $request->txtUsername;
            $order->email = $request->txtEmail;
            $order->address = $request->txtAddress;
            $order->phone = $request->txtPhone;
            $order->money = Cart::subtotal(0, ",", "");
            $order->message = $request->txtNote;
            $order->code_order = mt_rand();
            $order->save();

            $id_order = $order->id;
            //$orderdetails = array();
            foreach(Cart::content() as $key => $cart) {
                $orderdetail = new OrderDetail;
                $orderdetail->order_id = $id_order;
                $orderdetail->price = $cart->price;
                $orderdetail->quantity = $cart->qty;
                $orderdetail->product_id = $cart->id;
                $orderdetail->save();
                \DB::table('products')->where('id', $cart->id)->increment('product_pay');
                $product = Product::find($cart->id);
                $product->quantity = $product->quantity - $cart->qty;
                $product->save();
            }
            Mail::to($order->email)->send(new ShoppingMail($order));
            Cart::destroy();
            \Session::flash('toastr', [
                    'type' => 'success',
                    'message' => 'Đặt hàng thành công !'
                ]);
            return redirect()->route('index');
    }
}
