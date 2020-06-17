<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExports implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dataUser = User::select('name', 'email', 'ruler')->get();

        foreach($dataUser as $key => $val) {
        	if ($val->ruler == 0) {
        		$dataUser[$key]->ruler = 'Người dùng';
        	} else if ($val->ruler == 1) {
        		$dataUser[$key]->ruler = 'Admin';
        	} else if ($val->ruler == 2) {
        		$dataUser[$key]->ruler = 'Cộng tác viên';
        	}
        }
        return $dataUser;
    }

    public function headings(): array {
    	return [
    		'Tên người dùng',
    		'Email',
    		'Quyền truy cập'
    	];
    }
}
