<?php

namespace App\Http\Controllers;

use ESHDaVinci\API\Client;
use App\Repositories\BarRepository;
use App\Repositories\BowRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $client;
    private $barData;
    private $bowData;
    private $transData;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $client, BarRepository $barData, BowRepository $bowData, TransactionRepository $transData)
    {
        $this->client = $client;
        $this->barData = $barData;
        $this->bowData = $bowData;
        $this->transData = $transData;
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


    public function payments()
    {
        $transactions = $this->transData->getTransactions();
        $members = $this->client->getListOfNames();
        return view('pages.board_payments', [
            'transactions' => $transactions,
            'members' => $members
        ]);
    }


    public function bows()
    {
        $use = $this->bowData->getAllUsedBows();
        $members = $this->client->getListOfNames();
        return view('pages.board_bows', [
            'bows' => $use,
            'members' => $members
        ]);
    }


    public function customPayment(Request $request)
    {
        $status = $request->status;
        $trxId = $request->trxId;
        $url = "http://".$_SERVER['HTTP_HOST'];
        return view('pages.board_addPayment', [
            'status' => $status,
            'paymentUrl' => $url . '/pay/' . $trxId
        ]);
    }


    public function customPaymentPost(Request $request)
    {
        $user = $request->session->get('userId');
        $description = $request->description;
        $amount = $request->amount;

        $transactionId = $this->transData->customTransactionWithUser($user, $description, $amount);
        if (!$transactionId) {
            return redirect('/board/payment/add?status=fail');
        }

        return redirect('/board/payment/add?status=success&trxId=' . $transactionId);
    }


    public function addMember(Request $request)
    {
        $status = $request->status;
        return view('pages.board_addMember', [
            'status' => $status
        ]);
    }

    public function addMemberPost(Request $request)
    {
        /**
         * First level processing: basic
         */

        $required = [
            'initials',
            'first_name',
            'surname',
            'address',
            'address_number',
            'postal_address',
            'city',
            'home_phone',
            'primary_email',
            'institution',
            'birthdate',
            'study'
        ];

        foreach ($required as $r) {
            if (!isset($request->{$r}) && $request->{$r} !== "") {
                return redirect('/board/members/add?status=fail');
            }
        }

        /**
         * Second level check: check if conditions match
         */

        if ($request->ssc_check !== "on" || $request->general_check !== "on") {
            return redirect('/board/members/add?status=fail');
        }

        try {
            $birthdate = date("Y-m-d", strtotime($request->birthdate));
        } catch (\Exception $e) {
            return redirect('/board/members/add?status=fail');
        }

        $membershipChoice = "";
        $personRecord = [
            'active' => true,
            'initials' => $request->initials,
            'first_name' => $request->first_name,
            'infix' => $request->infix ?? null,
            'last_name' => $request->surname,
            'address_street' => $request->address,
            'address_number' => $request->address_number,
            'address_zip' => $request->postal_address,
            'address_city' => $request->city,
            'address_country' => $request->country ?: "The Netherlands",
            'phone_home' => $request->home_phone,
            'email_primary' => $request->primary_email,
            'pref_email' => '2',
            'pref_newsletter' => '1',
            'pref_mail' => '2',
            'pref_magazine' => '3',
            'department_id' => $request->institution,
            'birthdatebug' => $birthdate,
            'external_NHB' => "8", // So ugly, so hardcoded :(
            "EHBO_certificate" => "9",
            "honorary_member" => "13",
            "bhv_certificate" => "5",
            "bar_certificate" => "3",
            "study" => $request->study,
            "generation_id" => date('Y')
        ];

        /**
         * Third level check: check if either external nhb, or selection is made
         */
        if ($request->external_nhb) {
            $membershipChoice = "EXTERNAL_MEMBER";
            $personRecord['external_NHB'] = "7";
            $personRecord['NHB_number'] = $request->nhb_number;
        } elseif (isset($request->membership) && $request->membership === "RECR") {
            $membershipChoice = "RECREATIONIST";
        } elseif (isset($request->membership) && $request->membership === "MEM") {
            $membershipChoice = "MEMBER";
        } else {
            return redirect('/board/members/add?status=fail');
        }

        try {
            $this->client->createPerson($personRecord);
            $name = $request->first_name . " " . $request->infix . " " . $request->surname;
            $this->sendMailForPersonCreation($name, $membershipChoice);
        } catch (\Exception $e) {
            return redirect('/board/members/add?status=fail');
        }

        return redirect('/board/members/add?status=success');
    }

    private function sendMailForPersonCreation($name, $membershipChoice)
    {
        $from = "barsysteem@eshdavinci.nl";
        $to = "secretaris@eshdavinci.nl";
        $subject = "New member subscribed!";
        $message = "Dear secretary, a new member subscribed: " . $name . " and they want to get the membership type of: " . $membershipChoice . ". Please arrange this in Lassie. Kind regards, B.arsysteem";
        $headers = "From:" . $from;
        mail($to, $subject, $message, $headers);
        return;
    }
}
