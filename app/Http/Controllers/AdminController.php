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
        $order = Order::where('status', 0)->count();
        $money = Order::sum('money');
    	return view('admin.pages.index', compact('user', 'order', 'money'));
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

    public function getOrderDetail($id) {
        $order = OrderDetail::with('product')->where('order_id', $id)->get();
        $info = Order::find($id);
        return view('admin.pages.order.orderdetail', compact('order', 'info'));
    }

    public function postOrderDetail(Request $request, $id) {
        $order = DB::table('orders')->where('id', $id)->update(['status'=> $request->transaction]);
        return redirect()->route('admin.order');
    }

    public function getFilterOrder(Request $req, $status) {

        if ($req->ajax()) {
            if ($status >= 0 && $status <= 2) {
                $filter = DB::table('orders')->where('status', $status)->get();
                $html = view('admin.pages.order.filter', compact('filter'))->render();
            } else if ($status == 3){
                $filter = DB::table('orders')->get();
                 $html = view('admin.pages.order.filter', compact('filter'))->render();
            }
            
            return response(['html' => $html]);
        }   
    }
}
