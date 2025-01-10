<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Bantuan;
use App\Models\GajiKaryawan;
use App\Models\HistoriPenempatan;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Mitra;
use App\Models\PesertaEvent;
use App\Models\Posisi;
use App\Models\Potongan;
use App\Models\Program;
use App\Models\Tabung;
use App\Models\Tunjangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DatatableController extends Controller
{
    public function index(Request $request, $tabel)
    {
        if ($request->ajax()) {
            switch ($tabel) {
                case 'peserta_qris':
                    // $data = PesertaEvent::select('*');
                    $query = DB::table('qris_transaction')
                        ->join('peserta_qris', 'qris_transaction.peserta_id', '=', 'peserta_qris.id')
                        ->select('qris_transaction.peserta_id', 'peserta_qris.nama_pemilik_qris AS nama_pemilik', 'peserta_qris.nama_usaha', DB::raw('COUNT(qris_transaction.id) AS total_transaksi'), DB::raw('SUM(qris_transaction.nominal) AS total_nominal'))
                        ->groupBy('qris_transaction.peserta_id', 'peserta_qris.nama_pemilik_qris', 'peserta_qris.nama_usaha')
                        ->orderBy('qris_transaction.peserta_id');
                    return DataTables::of($query)
                        ->addIndexColumn()
                        ->addColumn('total_nominal', function ($row) {
                            return 'Rp' . number_format($row->total_nominal);
                        })
                        ->rawColumns(['action', 'jenis_kelamin'])
                        ->toJson();
                    break;
                default:
                    return response()->json([
                        'draw' => 0,
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0,
                        'data' => []
                    ]);
                    break;
            }
        }
    }
}
