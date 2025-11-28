<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->header('id');

        // 🔹 Daily Sales (last 7 days)
        $dailySales = Invoice::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total_sales')
            )
            ->where('user_id', $user_id)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->take(7)
            ->get();

        // 🔹 Category-wise Sales (Pie Chart)
        $categorySales = Product::select(
                'category_id',
                DB::raw('COUNT(*) as total_products')
            )
            ->where('user_id', $user_id)
            ->groupBy('category_id')
            ->get();

        // 👇 এখানেই দুইটা variable পাঠানো হচ্ছে
        return view('pages.dashboard.analytics', compact('dailySales', 'categorySales'));
    }
}
