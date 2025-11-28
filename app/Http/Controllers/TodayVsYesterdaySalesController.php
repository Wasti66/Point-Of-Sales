<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Carbon\Carbon;

class TodayVsYesterdaySalesController extends Controller
{
    public function TodayVsYesterdaySales(Request $request){
        //return view('pages.dashboard.TodayVsYesterdaySales');
        $user_id = $request->header('id');

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        //todays sell
        $todaySales = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', $today)
            ->sum('total');

        //yesterdays sell    
        $yesterdaySales = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', $yesterday)
            ->sum('total');   
            
        $changePercent = 0;
        if ($yesterdaySales > 0) {
            $changePercent = (($todaySales - $yesterdaySales) / $yesterdaySales) * 100;
        }

        return view('pages.dashboard.TodayVsYesterdaySales', compact('todaySales', 'yesterdaySales', 'changePercent'));
            
    }
}
