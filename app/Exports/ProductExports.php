<?php

namespace App\Exports;
use App\Product;
use App\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductExports implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $productData = Product::select('id', 'name', 'price', 'promotional', 'quantity', 'category_id')->orderBy('id', 'DESC')->get();

        foreach ($productData as $key => $val) {
   			$cateName = Category::select('name')->where('id', $val->category_id)->first();
   			$productData[$key]->category_id = $cateName->name;
        }
        return $productData;
    }

    public function headings() :array
    {
    	return [
    		'ID',
    		'Tên sản phẩm',
    		'Giá sản phẩm',
    		'Giá khuyến mại',
    		'Số lượng',
    		'Danh mục'
    	];
    }
}
