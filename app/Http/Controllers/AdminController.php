<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Query to get the total earnings for the current year
        $totalEarningsAnnual = Payment::whereYear('created_at', $currentYear)
        ->sum('amount');
        // Query to get the total earnings for the current month
        $totalEarningsMonth = Payment::where(DB::raw('MONTH(created_at)'), $currentMonth)
            ->where(DB::raw('YEAR(created_at)'), $currentYear)
            ->sum('amount');
        $totalInventory = Inventory::sum('quantity');
        $totalPending = Payment::sum('qty');

        return view('admin.index', compact('totalEarningsMonth', 'totalEarningsAnnual', 'totalInventory', 'totalPending'));
    }
public function monthlyEarningsData()
{
    $currentYear = now()->year;

    // Fetch monthly earnings data for the current year
    $monthlyEarnings = Payment::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
        ->whereYear('created_at', $currentYear)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

    return response()->json($monthlyEarnings);
}
}
