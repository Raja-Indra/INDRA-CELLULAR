<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $providers = Provider::count();
        $users = User::count();
        $produks = Produk::count();

        // Data untuk Grafik Transaksi (Dihapus karena Transaksi tidak ada)
        $labels = [];
        $data = [];

        // Data untuk Tabel Produk Terjual (Dihapus karena Transaksi tidak ada)
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();
        $soldProducts = [];


        return view('home', compact(
            'providers',
            'users',
            'produks',
            'labels',
            'data',
            'soldProducts',
            'startDate',
            'endDate'
        ));
    }
}
