<?php

namespace App\Http\Controllers;

use ESHDaVinci\API\Client;

class MainController extends Controller
{
    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function home()
    {
        return view('pages.home');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function bar()
    {
        return view('pages.bar');
    }

    public function bows()
    {
        return view('pages.bows');
    }
}
