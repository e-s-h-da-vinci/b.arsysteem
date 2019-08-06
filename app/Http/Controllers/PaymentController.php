<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $transData;
    private $gateway;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionRepository $transData)
    {
        $this->transData = $transData;

        $this->gateway = Omnipay::create('Sisow');
        $this->gateway->initialize(array(
           'shopId' => '',
           'merchantId' => env('SISOW_MERCHANT_ID'),
           'merchantKey' => env('SISOW_MERCHANT_KEY'),
           'testMode' => env('SISOW_TEST'),
       ));
    }

    public function pay(Request $request, $id)
    {
        $payment = $this->transData->get($id);
        if (is_null($payment)) {
            return redirect('');
        }

        if ($payment->paid) {
            return view('payment.done', [
                'payment' => $payment
            ]);
        }

        /** Detect if trxId is set */
        $trxId = $request->trxid;
        if (!isset($trxId)) {
            $response = $this->gateway->fetchIssuers()->send();
            if ($response->isSuccessful()) {
                $banks = $response->getIssuers();
                $array = [];
                foreach ($banks as $bank) {
                    $array[$bank->getId()] = $bank->getName();
                }

                return view('payment.pay', [
                    'payment' => $payment,
                    'banks' => $array
                ]);
            }

            return view('payment.api_error');
        } else {
            // It is set, process this transaction as paid
            $response = $this->gateway->completePurchase()->send();
            if ($response->isSuccessful()) {
                $rawId = $response->getTransactionId();
                $id = $this->transData->decodeId($rawId);
                if (!is_null($id) && $id === $payment['id']) {
                    $reference = $response->getTransactionReference();
                    if ($this->transData->processPaid($payment, $reference)) {
                        return view('payment.done', [
                            'payment' => $payment
                        ]);
                    } else {
                        return view('payment.fail', [
                            'id' => $response->getTransactionId(),
                            'trxId' => $response->getTransactionReference(),
                            'code' => 'InternalFailure',
                            'message' => 'We could not process your transaction internally.'
                        ]);
                    }
                } else {
                    return view('payment.fail', [
                        'id' => $response->getTransactionId(),
                        'trxId' => $response->getTransactionReference(),
                        'code' => 'GeneralFailure',
                        'message' => 'Ids in your request do not correspond'
                    ]);
                }
            } else {
                return view('payment.fail', [
                    'id' => $response->getTransactionId(),
                    'trxId' => $response->getTransactionReference(),
                    'code' => $response->getCode(),
                    'message' => $response->getMessage()
                ]);
            }
        }
    }

    public function processPay(Request $request, $id)
    {
        $payment = $this->transData->get($id);
        if (is_null($payment)) {
            return redirect('');
        }

        if ($payment->paid) {
            return redirect('pay/' . $id);
        }

        $bankId = $request->bankId;
        if (!isset($bankId)) {
            return redirect('pay/' . $id);
        }

        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $response = $this->gateway->purchase(array(
            'amount' => (string) $payment['amount'],
            'description' => $payment['description'],
            'issuer' => $bankId,
            'transactionId' => $this->transData->encodeId($payment['id']),
            'returnUrl' => $url,
            'notifyUrl' => $url,
        ))->send();

        if ($response->isRedirect()) {
            return $response->redirect();
        } else {
            return view('payment.fail', [
                'id' => $id,
                'trxId' => $response->getTransactionReference(),
                'code' => $response->getCode(),
                'message' => $response->getMessage()
            ]);
        }
    }
}
