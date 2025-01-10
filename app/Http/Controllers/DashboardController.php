<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Dashboard';
        return view('v_dashboard', compact('pageTitle'));
    }

    public function diagramBatang()
    {

        $query = DB::table('qris_transaction')
            ->leftJoin('peserta_event', 'qris_transaction.peserta_id', '=', 'peserta_event.id')
            ->leftJoin('ref_event', 'peserta_event.event_id', '=', 'ref_event.id')
            ->select('ref_event.nama_event', DB::raw('SUM(qris_transaction.nominal) as total_nominal'), DB::raw('COUNT(qris_transaction.id) as total_transaksi'))
            ->groupBy('ref_event.nama_event')->orderBy('total_nominal', 'DESC')
            ->limit(5)->get();

        foreach ($query as $value) {
            $categories[] = $value->nama_event;
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

    public function diagramLine()
    {
        $query = DB::table('qris_transaction')
            ->leftJoin('peserta_event', 'qris_transaction.peserta_id', '=', 'peserta_event.id')
            ->select(DB::raw('DATE_FORMAT(qris_transaction.tanggal_transaksi,"%Y-%m-%d") as bulan'), DB::raw('SUM(qris_transaction.nominal) as total_nominal'))
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
