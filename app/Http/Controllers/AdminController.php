<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderDetail;
use DB;

class AdminController extends Controller
{
    public function getIndex() {
    	$user = User::count();
    	return view('admin.pages.index', compact('user'));
    }

    public function getOrder() {
    	$order = Order::orderBy('id', 'DESC')->paginate(10);
    	return view('admin.pages.order.list', compact('order'));
    }
    public function deleteOrder($id) {
    	$order = Order::find($id);
    	\DB::table('order_details')->where('order_id',$id)->delete();
    	
    	$order->delete();

    	return redirect()->back();
    }

    public function orderDetail(Request $request,$id) {
        
        if ($request->ajax()) {

            $orders = OrderDetail::with('product')->where('order_id', $id)->get();
            $html = view('admin.pages.order.orderdetail', compact('orders'))->render();
            
            return response(['html' => $html]);

        }
    
    }
}
