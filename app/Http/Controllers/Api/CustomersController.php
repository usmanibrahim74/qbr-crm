<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{


    public function getCustomers(){

        $customers = Customer::all();

        return response()->json($customers);
    }

    public function addCustomer(Request $request){

        dd($request->all());

        $customer = new Customer();
        $customer->create($request->all());

        return response()->json([
           'status' => 'success',
           'message' => 'Customer has been added'
        ]);

    }
}
