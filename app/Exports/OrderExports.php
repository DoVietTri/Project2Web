<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExports implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$orderData = Order::select('code_order', 'name', 'address', 'email', 'phone', 'money', 'status')->get();
       	
       	foreach ($orderData as $key => $val) {
       		
       		if ($val->status == 0) {
       			$orderData[$key]->status = 'Chờ xử lý';
       		} else if ($val->status == 1) {
       			$orderData[$key]->status = 'Đang giao hàng';
       		} else if ($val->status == 2) {
       			$orderData[$key]->status = 'Đã xử lý';
       		}
       	}

       	return $orderData;
    }

    public function headings(): array {
    	return [
    		'Mã đơn hàng',
    		'Tên khách hàng',
    		'Địa chỉ',
    		'Email',
    		'Số điện thoại',
    		'Tổng tiền',
    		'Tình trạng đơn hàng'
    	];
    }
}
