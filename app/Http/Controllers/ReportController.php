<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function ReportPage(){
        return view('pages.dashboard.ReportPage');
    }

    public function SalesReport(Request $request){
        $user_id = $request->header('id');
        $FormDate = date('Y-m-d',strtotime($request->FormDate));
        $ToDate = date('Y-m-d',strtotime($request->ToDate));

        $total = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('total');
        $discount = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('discount');
        $vat = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('vat');
        $payable = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('payable');

        $list = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->with('customer')->get();

        $data =[
            'total' => $total,
            'discount' => $discount,
            'vat' => $vat,
            'payable' => $payable,
            'list' => $list,
            'FormDate' => $FormDate,
            'ToDate' => $ToDate
        ];

        $pdf = Pdf::loadView('report.SalesReport', $data);
        return $pdf->download('invoice.pdf');
    }
    public function CustomerReport(Request $request){
        $user_id = $request->header('id');
        $FormDateCustomer = date('Y-m-d',strtotime($request->FormDateCustomer));
        $ToDateCustomer = date('Y-m-d',strtotime($request->ToDateCustomer));

        $totalName = Customer::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDateCustomer)->whereDate('created_at', '<=', $ToDateCustomer)->count('name');

        $totalEmail = Customer::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDateCustomer)->whereDate('created_at', '<=', $ToDateCustomer)->count('email');

        $totalPhone = Customer::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDateCustomer)->whereDate('created_at', '<=', $ToDateCustomer)->count('phone');

        $list = Customer::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDateCustomer)->whereDate('created_at', '<=', $ToDateCustomer)->get();

        $date =[
            'totalName' => $totalName,
            'totalEmail' => $totalEmail,
            'totalPhone' => $totalPhone,
            'list' => $list,
            'FormDateCustomer' => $FormDateCustomer,
            'ToDateCustomer' => $ToDateCustomer
        ];

        $customerPdf = pdf::loadView('report.CustomerReport',$date);
        return $customerPdf->download('invoice.pdf');

    }

    public function ProductReport(Request $request){
        $user_id = $request->header('id');
        $FormDateProduct = date('Y-m-d',strtotime($request->FormDateProduct));
        $ToDateProduct = date('Y-m-d',strtotime($request->ToDateProduct));

        $productName = Product::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDateProduct)->whereDate('created_at', '<=', $ToDateProduct)->count('name');
        $productPrice = Product::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDateProduct)->whereDate('created_at', '<=', $ToDateProduct)->sum('price');

        $list = Product::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDateProduct)->whereDate('created_at', '<=', $ToDateProduct)->get(); 
        
        $data=[
            'productName' => $productName,
            'productPrice' => $productPrice,
            'list' => $list,
            'FormDateProduct' => $FormDateProduct,
            'ToDateProduct' => $ToDateProduct
        ];

        $productPdf = Pdf::loadView('report.ProductReport', $data);
        return $productPdf->download('invoice.pdf');

    }
}
