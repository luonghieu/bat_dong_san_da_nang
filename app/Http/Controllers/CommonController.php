<?php

namespace App\Http\Controllers;

use App\Models\Street;
use App\Models\Village;
use Illuminate\Http\Request;
use App\Models\District;

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
        $districtId = $request->id;

        $listVillages = Village::all()->where('district_id',$districtId);
        $listStreets = Street::all()->where('district_id',$districtId);

        echo json_encode([
            'villages' => $listVillages,
            'streets' => $listStreets
        ]);
    }
}