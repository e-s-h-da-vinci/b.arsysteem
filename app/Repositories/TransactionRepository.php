<?php
namespace App\Repositories;

use App\Models\PaymentTransaction;

class TransactionRepository
{
    private $barData;
    private $hashids;
    public function __construct(BarRepository $barRepo)
    {
        $this->barData = $barRepo;
        $this->hashids = new \Hashids\Hashids(env('APP_KEY'));
    }

    public function getTransactions()
    {
        return PaymentTransaction::all()->sortByDesc('created_at')->map(function ($item) {
            $item->encoded_id = $this->encodeId($item->id);
            $item->user_id = explode(":", $item->machine_instruction)[0];
            return $item;
        });
    }

    public function customTransactionWithUser($id, $description, $amount)
    {
        if ((double) $amount < 1) {
            return false;
        }

        $payment = new PaymentTransaction();
        $payment->description = $description;
        $payment->amount = (double) $amount;
        $payment->paid = false;
        $payment->machine_instruction = $id;

        if (!$payment->save()) {
            return false;
        }

        $id = $this->hashids->encode($payment->id);
        return $id;
    }

    public function purchaseBarSaldoWithUser($id, $productId)
    {
        $prod = $this->barData->getUpgradable($productId);
        if (is_null($prod)) {
            return false;
        }

        $payment = new PaymentTransaction();
        $payment->description = $prod['name'];
        $payment->amount = (double) - $prod['price'];
        $payment->paid = false;
        $payment->machine_instruction = $id . ":SALDO:" . $productId;

        if (!$payment->save()) {
            return false;
        }

        $id = $this->hashids->encode($payment->id);

        return $id;
    }

    public function encodeId($id)
    {
        return $this->hashids->encode($id);
    }

    public function decodeId($hash)
    {
        $id = $this->hashids->decode($hash);
        if (!isset($id[0]) || !is_numeric($id[0])) {
            return null;
        }
        return $id[0];
    }

    public function get($id)
    {
        $id = $this->hashids->decode($id);
        if (!isset($id[0]) || !is_numeric($id[0])) {
            return null;
        }

        return PaymentTransaction::where(['id' => $id])->first();
    }

    private function processMachineInstruction($payment)
    {
        $mi = $payment->machine_instruction;

        $parts = explode(":", $mi);

        // Only ID
        if (count($parts) === 1) {
            return true;
        }

        $userId = (int) array_shift($parts);
        $instruction = array_shift($parts);
        $options = $parts;

        if ($instruction === "SALDO") {
            return $this->processMachineSaldo($userId, $options);
        }

        return false;
    }

    public function processPaid($payment, $reference)
    {
        $payment->ext_ref = $reference;
        $payment->paid = true;
        if (!$payment->save()) {
            return false;
        }

        if (!$this->processMachineInstruction($payment)) {
            return false;
        }

        return true;
    }

    private function processMachineSaldo($userId, $options)
    {
        // Always has layout: USERID:'SALDO':PRODID without other params
        $prodId = $options[0];
        $prod = $this->barData->getUpgradable($prodId);
        if (is_null($prod)) {
            return false;
        }

        // Saldo in DB is negative, convert to positive
        return $this->barData->addSaldo($userId, 0 - $prod->price, $prodId);
    }
}
