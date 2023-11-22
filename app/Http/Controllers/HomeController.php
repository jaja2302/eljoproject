<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function index()
    {

        $currentDate = Carbon::now();

        // Get the start and end of the current week
        $startOfWeek = $currentDate->startOfWeek()->format('Y-m-d'); // Start of the current week (usually Monday)
        $endOfWeek = $currentDate->endOfWeek()->format('Y-m-d'); // End of the current week (usually Sunday)

        // dd($startOfWeek, $endOfWeek);

        $features = DB::connection('mysql')
            ->table('buku')
            ->select('buku.*')
            ->whereBetween('upload_date', [$startOfWeek, $endOfWeek])
            ->get();

        $features = json_decode($features, true);
        // dd($features);

        $listbuku = DB::connection('mysql')
            ->table('buku')
            ->select('buku.*')
            ->where('status_buku', 0)
            ->get();

        $listbuku = json_decode($listbuku, true);

        // dd($listbuku);

        return view('dashboard.katalogbuku', ['features' => $features, 'buku' => $listbuku]);
    }
}
