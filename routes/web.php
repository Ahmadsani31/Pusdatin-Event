<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/sql', function () {
    // return view('v_dashboard');

    $query = DB::table('qris_transaction')
        ->join('peserta_qris', 'qris_transaction.peserta_id', '=', 'peserta_qris.id')
        ->select('qris_transaction.peserta_id', 'peserta_qris.nama_pemilik_qris AS nama_pemilik', 'peserta_qris.nama_usaha', DB::raw('COUNT(qris_transaction.id) AS total_transaksi'), DB::raw('SUM(qris_transaction.nominal) AS total_nominal'))
        ->groupBy('qris_transaction.peserta_id', 'peserta_qris.nama_pemilik_qris', 'peserta_qris.nama_usaha')
        ->orderBy('qris_transaction.peserta_id')->get();

    foreach ($query as $key => $value) {
        var_dump($value);
    }
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/datatable/{tabel}', [DatatableController::class, 'index'])->name('datatable');

Route::get('diagram/batang', [DashboardController::class, 'diagramBatang'])->name('diagram.batang');
Route::get('diagram/line', [DashboardController::class, 'diagramLine'])->name('diagram.line');
Route::get('diagram/pie', [DashboardController::class, 'diagramPie'])->name('diagram.pie');
