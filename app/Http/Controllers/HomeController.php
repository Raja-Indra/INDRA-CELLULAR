<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::count();
        $providers = Provider::count();
        $transactionCount = Transaksi::count();

        // Data untuk grafik transaksi
        $transactions = Transaksi::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->limit(10) // Ambil 10 data terakhir untuk contoh
            ->get();

        $labels = $transactions->pluck('date');
        $data = $transactions->pluck('count');

        return view('home', compact('users', 'providers', 'transactionCount', 'labels', 'data'));
    }
}
