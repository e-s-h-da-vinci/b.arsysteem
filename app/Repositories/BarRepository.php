<?php
namespace App\Repositories;

use App\Models\BarItem;
use App\Models\BarTransaction;
use App\Models\BarSaldo;

class BarRepository
{
    public function getAllBarItems()
    {
        return BarItem::where(['product' => true, 'hidden' => false])->get();
    }

    public function getUpgradables()
    {
        return BarItem::where(['product' => false, 'hidden' => false])->get();
    }

    public function getSaldoForUser($id)
    {
        // If undefined, it's always 0
        return BarSaldo::where(['user_id' => $id])->first()['saldo'] ?? 0;
    }

    public function getTransactionsForUser($id)
    {
        return BarTransaction::where(['user_id' => $id])->with('product')->orderBy('updated_at', 'DESC')->get();
    }
}
