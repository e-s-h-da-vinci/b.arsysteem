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

        return view('pages.bar', [
            'items' => $items,
            'saldo' => $saldo,
            'transactions' => $transactions,
            'upgradables' => $upgradables
        ]);
    }

    public function processBar(Request $request)
    {
        echo json_encode($request->all());
        die();
    }

    public function bows()
    {
        return view('pages.bows');
    }
}
