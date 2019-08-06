<?php

namespace App\Http\Controllers;

use ESHDaVinci\API\Client;
use App\Repositories\BarRepository;
use App\Repositories\BowRepository;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $client;
    private $barData;
    private $bowData;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $client, BarRepository $barData, BowRepository $bowData)
    {
        $this->client = $client;
        $this->barData = $barData;
        $this->bowData = $bowData;
    }

    public function home()
    {
        return view('pages.home');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function bar(Request $request)
    {
        $id = $request->session->get('userId');
        $saldo = $this->barData->getSaldoForUser($id);
        $items = $this->barData->getAllBarItems();
        $transactions = $this->barData->getTransactionsForUser($id);
        $upgradables = $this->barData->getUpgradables();
        $status = $request->status;

        return view('pages.bar', [
            'items' => $items,
            'saldo' => $saldo,
            'transactions' => $transactions,
            'upgradables' => $upgradables,
            'status' => $status
        ]);
    }

    public function processBar(Request $request)
    {
        if (!isset($request->amount)) {
            return redirect('/bar?status=fail');
        }

        $amounts = $request->amount;
        $id = $request->session->get('userId');
        $result = $this->barData->purchaseWithUser($id, $amounts);

        if ($result) {
            return redirect('/bar?status=ok');
        }

        return redirect('/bar?status=fail');
    }

    public function bows(Request $request)
    {
        $id = $request->session->get('userId');
        $bows = $this->bowData->getBows();
        $status = $request->status;
        $history = $this->bowData->getUsedBows($id);
        return view('pages.bows', [
            'bows' => $bows,
            'history' => $history,
            'status' => $status
        ]);
    }

    public function processBow(Request $request)
    {
        if (!isset($request->bow)) {
            return redirect('/bows?status=fail');
        }

        $bow = $request->bow;
        $id = $request->session->get('userId');
        $result = $this->bowData->addBowUse($id, $bow);

        if ($result) {
            return redirect('/bows?status=ok');
        }

        return redirect('/bows?status=fail');
    }
}
