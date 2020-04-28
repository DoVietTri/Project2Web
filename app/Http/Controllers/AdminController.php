<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderDetail;

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
    	$order_detail = Order::find($id)->orderdetail;

    	$order->delete();
    	$order_detail->delete();
    	return redirect()->back();
    }
}
