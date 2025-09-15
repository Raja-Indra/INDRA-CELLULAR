<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Transaksi;
use App\Models\User;
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
        $transactionCount = Transaksi::count();
        $providers = Provider::count();
        $users = User::count();

        // Data untuk Grafik Transaksi
        $transactions = Transaksi::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $transactions->pluck('date');
        $data = $transactions->pluck('count');

        // Data untuk Tabel Produk Terjual
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();

        $soldProducts = DB::table('produk_transaksi')
            ->join('produks', 'produk_transaksi.produk_id', '=', 'produks.id')
            ->join('transaksis', 'produk_transaksi.transaksi_id', '=', 'transaksis.id')
            ->join('providers', 'produks.provider_id', '=', 'providers.id') // Tambahkan join ini
            ->select('produks.nama_produk', 'providers.nama_provider', DB::raw('SUM(produk_transaksi.jumlah) as total_terjual')) // Tambahkan nama_provider
            ->whereBetween('transaksis.created_at', [$startDate, $endDate])
            ->groupBy('produks.nama_produk', 'providers.nama_provider') // Tambahkan group by untuk provider
            ->orderBy('total_terjual', 'desc')
            ->get();



        return view('home', compact(
            'transactionCount',
            'providers',
            'users',
            'labels',
            'data',
            'soldProducts',
            'startDate',
            'endDate'
        ));
    }
}
