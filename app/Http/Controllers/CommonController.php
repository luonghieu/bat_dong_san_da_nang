<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;

class CommonController extends Controller
{
    // employee management
    public function listDistricts()
    {
        $list  = District::all();
        echo json_encode($list);
    }
}