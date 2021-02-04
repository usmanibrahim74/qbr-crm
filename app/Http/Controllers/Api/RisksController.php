<?php

namespace App\Http\Controllers\Api;

use App\Models\Risk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RisksController extends Controller
{

    public function getRisks(){
        $risks = Risk::all();

        return response()->json($risks);
    }

}
