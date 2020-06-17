<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderDetail;
use DB;
use App\Contact;
use Carbon\Carbon;
use Excel;
use App\Exports\OrderExports;


class AdminController extends Controller
{
    public function getIndex() {
        $user = User::count();
        $order = Order::where('status', 0)->count();

        //Hàm lấy doanh thu tháng hiện tại
        $money = Order::whereMonth('created_at', date('m'))->where('status', 2)->sum('money');
        

        //Lấy doanh thu của từng tháng trong năm
        $totalMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $total = Order::whereMonth('created_at', $i)->where('status', 2)->sum('money');
            array_push($totalMonth, $total);
        }

        $totalMonth = json_encode($totalMonth);

        //Thống kê trạng thái đơn hàng
        //Đã xử lý
        $statusSuccess = Order::where('status', 2)->select('id')->count();
        //Chờ xử lý
        $statusDefault = Order::where('status', 0)->select('id')->count();
        //Đang giao hàng
        $statusProcess = Order::where('status', 1)->select('id')->count();

        $statusTransaction = [$statusDefault, $statusProcess, $statusSuccess];
        $statusTransaction = json_encode($statusTransaction);

        //Thống kê liên hệ mới
        $contact_new = Contact::where('status', 0)->count();

    	return view('admin.pages.index', compact('user', 'order', 'money', 'statusTransaction', 'totalMonth', 'contact_new'));
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

    public function excel() {
        return Excel::download(new OrderExports, 'order.xlsx');
    }
}
