<?php

namespace App\Http\Controllers;

use ESHDaVinci\API\Client;
use App\Repositories\BarRepository;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $client;
    private $barData;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $client, BarRepository $barData)
    {
        $this->client = $client;
        $this->barData = $barData;
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

    public function bows()
    {
        return view('pages.bows');
    }
}
