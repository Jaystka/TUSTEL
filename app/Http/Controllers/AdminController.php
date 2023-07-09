<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        $rental = Rental::count();
        $customer = Customer::count();
        $product = Product::count();
        $payment = Payment::whereMonth('created_at', date('m'))
            ->sum('total');
        $lastPayment = Payment::whereMonth('created_at', date("m", strtotime("-1 month")))
            ->sum('total');
        $total = Payment::select(Payment::raw("sum(total) as totals"), Payment::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(Payment::raw("MONTH(created_at)"), "created_at")
            ->pluck('totals', 'month_name');

        $labels = $total->keys();
        $data = $total->values();

        return view('dashboard.index', compact('rental', 'customer', 'payment', 'product', 'lastPayment', 'data', 'labels'));
    }
}
