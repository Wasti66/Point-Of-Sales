<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard Page with Summary + Charts
    public function salesData(Request $request)
    {
        $user_id = $request->header('id');

        // Summary Data
        $product = Product::where('user_id',$user_id)->count();
        $category = Category::where('user_id',$user_id)->count();
        $customer = Customer::where('user_id',$user_id)->count();
        $invoice = Invoice::where('user_id',$user_id)->count();
        $total = Invoice::where('user_id',$user_id)->sum('total');
        $vat = Invoice::where('user_id',$user_id)->sum('vat');
        $payable = Invoice::where('user_id',$user_id)->sum('payable');

        // Daily Sales (Last 30 Days)
        $dailySales = Invoice::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total_sales')
        )
        ->where('user_id', $user_id)
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // Category-wise Sales
        $categorySales = Product::select(
                'category_id',
                DB::raw('COUNT(*) as total_products')
            )
            ->where('user_id', $user_id)
            ->groupBy('category_id')
            ->get();

        return view('pages.dashboard.dashboard', compact(
            'product', 'category', 'customer', 'invoice',
            'total', 'vat', 'payable',
            'dailySales', 'categorySales'
        ));
    }

    // API for Summary
    public function Summary(Request $request): array
    {
        $user_id = $request->header('id');

        $product = Product::where('user_id',$user_id)->count();
        $category = Category::where('user_id',$user_id)->count();
        $customer = Customer::where('user_id',$user_id)->count();
        $invoice = Invoice::where('user_id',$user_id)->count();
        $total = Invoice::where('user_id',$user_id)->sum('total');
        $vat = Invoice::where('user_id',$user_id)->sum('vat');
        $payable = Invoice::where('user_id',$user_id)->sum('payable');

        return [
            'product' => $product,
            'category' => $category,
            'customer' => $customer,
            'invoice' => $invoice,
            'total' => $total,
            'vat' => $vat,
            'payable' => $payable
        ];
    }
}
