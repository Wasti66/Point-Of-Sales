<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
     
    public function InvoicePages(){
        return view('pages.dashboard.invoicePage');
    }   
    public function SalePages(){
        return view('pages.dashboard.salePage');
    }

    public function invoiceCreate(Request $request){
      DB::beginTransaction();

      try{

        $user_id = $request->header('id');
        $customer_id = $request->input('customer_id');
        $total = $request->input('total');
        $discount = $request->input('discount');
        $vat = $request->input('vat');
        $payable = $request->input('payable');

        $invoice = Invoice::create([
            'total' => $total,
            'discount' => $discount,
            'vat' => $vat,
            'payable' => $payable,
            'user_id' => $user_id,
            'customer_id' => $customer_id,
        ]);

        $invoiceID = $invoice->id;
        
        $products = $request->input('products');
        foreach($products as $Eachproduct){
            InvoiceProduct::create([
                'invoice_id' => $invoiceID,
                'user_id' => $user_id,
                'product_id' => $Eachproduct['product_id'],
                'qty' => $Eachproduct['qty'],
                'sale_price' => $Eachproduct['sale_price'],
            ]);
        }
        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Invoice create successfully'
        ], 200);

      }
      catch(Exception $e){
        DB::rollBack();
        return response()->json([
            'status' => 'failed',
            'message' => $e->getMessage(),
            //'message' => 'User registration failed'
        ], 401);
      }

    }

    public function invoiceSelect(Request $request){
        $user_id = $request->header('id');
        $invoiceSelect = Invoice::where('user_id',$user_id)->with('customer')->get();
        return response()->json($invoiceSelect);
    }

    public function invoiceDetails(Request $request){
        $user_id = $request->header('id');
        $customerDetails = Customer::where('user_id',$user_id)->where('id',$request->input('cus_id'))->first();
        $invoiceTotal = Invoice::where('user_id','=',$user_id)->where('id',$request->input('inv_id'))->first();
        $invoiceProduct = InvoiceProduct::where('invoice_id',$request->input('inv_id'))->where('user_id',$user_id)->with('product')->get();
        return array(
          'customer'=>$customerDetails,
          'invoice'=>$invoiceTotal,
          'product'=>$invoiceProduct
        );
    }

    public function invoiceDelete(Request $request){
        DB::beginTransaction();
        try{

            $user_id = $request->header('id');
            InvoiceProduct::where('invoice_id', $request->input('inv_id'))->where('user_id',$user_id)->delete();
            Invoice::where('id',$request->input('inv_id'))->delete();
            DB::commit();
            return 1;

        }catch(Exception $e){
            DB::rollBack();
            return 0;
        }
    }    
}
