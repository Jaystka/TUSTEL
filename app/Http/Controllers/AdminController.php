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
    public function index()
    {
        $rental = Rental::Where('status', '=', '0')->count();
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
        $rentals = Rental::Where('status', '=', '0')
            ->orderByDesc('rentals.created_at')
            ->join('products', 'products.id_produk', '=', 'rentals.id_produk')
            ->join('customers', 'customers.id_customer', '=', 'rentals.id_customer')
            ->select('rentals.*', 'products.camera', 'customers.nama')
            ->paginate(5);

        $labels = $total->keys();
        $data = $total->values();

        return view('dashboard.index', compact('rental', 'customer', 'payment', 'product', 'lastPayment', 'data', 'labels', 'rentals'));
    }

    function paginationHome(Request $request)
    {
        if ($request->ajax()) {
            $rentals = Rental::Where('status', '=', '0')
                ->orderByDesc('rentals.created_at')
                ->join('products', 'products.id_produk', '=', 'rentals.id_produk')
                ->join('customers', 'customers.id_customer', '=', 'rentals.id_customer')
                ->select('rentals.*', 'products.camera', 'customers.nama')
                ->paginate(5);
        }
        return view('dashboard.paginate', compact('rentals'))->render();
    }
}
