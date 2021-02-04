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


        $customer = new Customer();
        $customer->create($request->all());

        return response()->json([
           'status' => 'success',
           'message' => 'Customer has been added'
        ]);

    }

    public function getCustomer($id){

        $customer = Customer::findOrFail($id);
        return response()->json($customer);

    }

    public function updateCustomer(Request $request, $id){

        $customer = Customer::findOrFail($id);
        $customer->fill($request->all())->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Customer has been updated'
        ]);

    }
}
