<?php

namespace App\Http\Controllers;

use App\Models\Street;
use App\Models\Village;
use App\Models\AssignTask;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Category;
use App\Models\UnitPrice;

class CommonController extends Controller
{
    // get list district
    public function listDistricts()
    {
        $list  = District::all();
        echo json_encode($list);
    }

    // getItemByDistrict
    public function getItemByDistrict(Request $request)
    {
        $districtId = $request->districtId;

        $listVillages = Village::all()->where('district_id',$districtId);
        $listStreets = Street::all()->where('district_id',$districtId);

        echo json_encode([
            'villages' => $listVillages,
            'streets' => $listStreets
        ]);
    }

    // gioithieu
    public function getLoaiNhaDat(Request $request)
    {
        $cat = Category::where('type_transaction', $request->type)->get();
        $unitPrice = UnitPrice::where('type_transaction', $request->type)->get();
        echo json_encode([
            'cat' => $cat,
            'unitPrice' => $unitPrice
        ]);
    }

    public function getCustomerByUserLogin(Request $request)
    {
        $objId = Session::get('obj')->id;
        $customer = AssignTask::join('customer', 'assign_task.customer_id','customer.id')->where('employee_id', $objId)->get()->pluck('customer.name', 'customer_id');
        echo json_encode($customer);
    }

     // gioithieu
    public function getSaleSearch()
    {
        $cat = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
        ->pluck('name', 'id')
        ->toArray();
        $price = [
            'Thỏa thuận',
            '< 500 triệu',
            '500 - 800 triệu',
            '800 - 1 tỷ',
            '1 - 5 tỷ',
            '> 5 tỷ'
        ];
        echo json_encode([
            'cat' => $cat,
            'price' => $price
        ]);
    }

     // gioithieu
    public function getLeaseSearch()
    {
        $cat = Category::where('type_transaction', Category::TYPETRANSACTION['lease'])
        ->pluck('name', 'id')
        ->toArray();
        $price = [
            'Thỏa thuận',
            '< 1 triệu',
            '1 - 5 triệu',
            '5 - 10 triệu',
            '10 - 40 triệu',
            '> 40 triệu'
        ];
        echo json_encode([
            'cat' => $cat,
            'price' => $price
        ]);
    }

}