<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function CustomerPage(){
        return view('pages.dashboard.customerPage');
    }
    
    //customers list
    function customersList(Request $request){
        $user_id = $request->header('id');
        return Customer::where('user_id', $user_id)->get();
    }
    //create customers
    function customerCreate(Request $request){
        try{
            $user_id = $request->header('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            Customer::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'user_id' => $user_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Customer add successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'
                //'message' => $e->getMessage()
            ], 200);
        }
        
    }
    //delete customers
    function deleteCustomer(Request $request){
        try{
            $user_id = $request->header('id');
            $customer_id = $request->input('id');
            Customer::where('id', $customer_id)
                    ->where('user_id', $user_id)
                    ->delete();
            return response()->json([
                    'status' => 'success',
                    'message' => 'Customer delete successfully' 
            ], 200);
        }catch(Exception $e){
            return response()->json([
                    'status' => 'failed',
                    'message' => $e->getMessage()
            ], 200);
        }
         
    }
    //customer by id
    function customerById(Request $request){
        $user_id = $request->header('id');
        $customer_id = $request->input('id');
        $customerById = Customer::where('id', $customer_id)->where('user_id', $user_id)->first();
        return response()->json($customerById);
    }
    //customer update
    function customerUpdate(Request $request){
        try{
            $user_id = $request->header('id');
            $customer_id = $request->input('id');

            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');

            Customer::where('user_id',$user_id)->where('id', $customer_id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Customer update successfully' 
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 200);
        }
        

    }
}
