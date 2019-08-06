<?php
namespace App\Repositories;

use App\Models\BarItem;
use App\Models\BarTransaction;
use App\Models\BarSaldo;

class BarRepository
{
    public function getAllBarItems()
    {
        return BarItem::where(['product' => true, 'hidden' => false])->orderBy('name', 'ASC')->get();
    }

    public function getUpgradables()
    {
        return BarItem::where(['product' => false, 'hidden' => false])->orderBy('name', 'ASC')->get();
    }

    public function getSaldoForUser($id)
    {
        // If undefined, it's always 0
        return BarSaldo::where(['user_id' => $id])->first()['saldo'] ?? 0;
    }

    public function getSaldos()
    {
        return BarSaldo::all();
    }

    public function getTransactionsForUser($id)
    {
        return BarTransaction::where(['user_id' => $id])->with('product')->orderBy('updated_at', 'DESC')->limit(40)->get();
    }

    public function getTransactions()
    {
        return BarTransaction::with('product')->orderBy('updated_at', 'DESC')->get();
    }

    private function processOnSaldo($id, $price)
    {
        if (!$this->checkSaldoExists($id)) {
            return false;
        }

        $saldo = BarSaldo::where(['user_id' => $id])->first();
        $saldo->saldo = $saldo->saldo - $price;
        return $saldo->save();
    }

    public function addSaldo($id, $amount)
    {
        if (!$this->checkSaldoExists($id)) {
            return false;
        }

        $amount = (double) $amount;

        $saldo = BarSaldo::where(['user_id' => $id])->first();
        $saldo->saldo = $saldo->saldo + $amount;
        if (!$saldo->save()) {
            return false;
        }

        // Always make sure that 0 is the manual recharge
        $transaction = new BarTransaction();
        $transaction->user_id = $id;
        $transaction->bar_item_id = 1;
        $transaction->amount = 0 - $amount;
        if (!$transaction->save()) {
            return false;
        }

        return true;
    }

    private function checkSaldoExists($id)
    {
        // Check if the user has a saldo
        $entry = BarSaldo::where(['user_id' => $id])->first()['saldo'];
        if (is_null($entry)) {
            $saldo = new BarSaldo();
            $saldo->user_id = $id;
            $saldo->saldo = 0;
            if (!$saldo->save()) {
                return false;
            }
        }
        return true;
    }

    public function purchaseWithUser($id, $purchaseArray)
    {
        if (!$this->checkSaldoExists($id)) {
            return false;
        }

        // There's a saldo now
        foreach ($purchaseArray as $prodKey => $amount) {
            for ($i = 0; $i < $amount; $i++) {
                // Deduct from saldo
                $prod = BarItem::where(['id' => $prodKey])->first();
                if (is_null($prod)) {
                    return false;
                }

                if (!$this->processOnSaldo($id, $prod->price)) {
                    return false;
                }

                // Add transaction
                $transaction = new BarTransaction();
                $transaction->user_id = $id;
                $transaction->bar_item_id = $prodKey;
                $transaction->amount = $prod->price;
                if (!$transaction->save()) {
                    return false;
                }
            }
        }

        return true;
    }
}
