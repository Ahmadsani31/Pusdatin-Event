<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class QrisTransactionsRepository
{
    public function getTopEventTransactions(int $limit = 5)
    {
        return DB::table('qris_transactions')
            ->leftJoin('peserta_events', 'qris_transactions.peserta_id', '=', 'peserta_events.id')
            ->leftJoin('ref_events', 'peserta_events.event_id', '=', 'ref_events.id')
            ->select(
                'ref_events.nama_event',
                DB::raw('SUM(qris_transactions.nominal) as total_nominal'),
                DB::raw('COUNT(qris_transactions.id) as total_transaksi')
            )
            ->groupBy('ref_events.nama_event')
            ->orderByDesc('total_nominal')
            ->limit($limit)
            ->get();
    }
}
