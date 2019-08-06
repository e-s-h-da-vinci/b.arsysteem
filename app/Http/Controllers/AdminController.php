<?php

namespace App\Http\Controllers;

use ESHDaVinci\API\Client;
use App\Repositories\BarRepository;
use App\Repositories\BowRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        return view('pages.board_home');
    }

    public function bar()
    {
        $transactions = $this->barData->getTransactions();
        $members = $this->client->getListOfNames();
        $saldos = $this->barData->getSaldos();
        return view('pages.board_bar', [
            'transactions' => $transactions,
            'members' => $members,
            'saldos' => $saldos
        ]);
    }

    public function addBarCredit(Request $request)
    {
        $user = $request->user_id;
        $amount = $request->amount;
        if (!isset($user) || !isset($amount)) {
            return redirect('/board/bar?status=fail');
        }

        if ($this->barData->addSaldo($user, $amount)) {
            return redirect('/board/bar?status=success');
        }

        return redirect('/board/bar?status=fail');
    }
}
