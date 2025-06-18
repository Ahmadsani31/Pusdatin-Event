<?php

namespace App\Http\Controllers;

use App\Services\QrisTransactionsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $qrisService;
    public function __construct(QrisTransactionsService $qrisService)
    {
        $this->qrisService = $qrisService;
    }

    public function index()
    {
        $pageTitle = 'Dashboard';
        return view('v_dashboard', compact('pageTitle'));
    }

    public function diagramBatang(Request $request)
    {

        if ($request->ajax()) {
            # code...
            $qrisData = $this->qrisService->getTopEventsSummary();
            return response()->json(['param' => true, 'items' => $qrisData]);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function diagramLine()
    {
        $query = DB::table('qris_transactions')
            ->leftJoin('peserta_events', 'qris_transactions.peserta_id', '=', 'peserta_events.id')
            ->select(DB::raw('DATE_FORMAT(qris_transactions.tanggal_transaksi,"%Y-%m-%d") as bulan'), DB::raw('SUM(qris_transactions.nominal) as total_nominal'))
            ->groupBy('bulan')->orderBy('bulan', 'DESC')->get();

        foreach ($query as $value) {
            $categories[] = $value->bulan;
            $jumlah[] = $value->total_nominal;
        }

        $series[] = [
            'name' => 'Nominal',
            'data' => $jumlah
        ];

        return response()->json(['param' => true, 'items' => [
            'series' => $series,
            'categories' => $categories
        ]]);
    }

    public function diagramPie()
    {

        $query = DB::table('peserta_qris')
            ->select(DB::raw('COUNT(*) as jumlah_usaha'), 'nama_usaha')
            ->groupBy('nama_usaha')->orderBy('jumlah_usaha', 'DESC')->get();

        foreach ($query as $value) {
            $categories[] = $value->nama_usaha;
            $jumlah[] = $value->jumlah_usaha;
        }

        $series[] = $jumlah;

        return response()->json(['param' => true, 'items' => [
            'series' => $jumlah,
            'categories' => $categories
        ]]);
    }
}
