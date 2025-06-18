<?php

namespace App\Services;

use App\Repositories\QrisTransactionsRepository;

class QrisTransactionsService
{
    protected $qrisRepo;

    public function __construct(QrisTransactionsRepository $qrisRepo)
    {
        $this->qrisRepo = $qrisRepo;
    }

    public function getTopEventsSummary()
    {
        $query = $this->qrisRepo->getTopEventTransactions();
        $data = [];
        foreach ($query as $key => $value) {
            $data[] = [
                'categories' => $value->nama_event,
                'jumlah' => $value->total_nominal
            ];
        }
        return $data;
    }
}
