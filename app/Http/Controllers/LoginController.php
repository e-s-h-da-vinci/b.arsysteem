<?php

namespace App\Http\Controllers;

use ESHDaVinci\API\Client;
use Illuminate\Http\Request;

class LoginController extends Controller
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

    public function login(Request $request)
    {
        $session = $request->session;
        if (!is_null($session->get('userId'))) {
            return redirect('');
        }

        $failed = $request->query('error');

        try {
            $members = $this->client->getListOfNames(true);
            asort($members);
            return view('login.login', ['members' => $members, 'error' => $failed]);
        } catch (\Exception $e) {
            return view('login.api_error');
        }
    }

    public function processLogin(Request $request)
    {
        $data = $request->all();
        if (!isset($data['userId']) || !isset($data['pincode'])) {
            return redirect('login');
        }

        try {
            // Now auth
            $bool = $this->client->authenticate($data['userId'], $data['pincode']);
            if (!$bool) {
                // Check if no password is registered
                $needsReplacing = $this->client->hasToSetPassword($data['userId']);
                if ($needsReplacing) {
                    return redirect('login/setNewPassword/'.$data['userId']);
                }

                return redirect('login?error=1');
            }

            // Get the data
            $member = $this->client->getMember($data['userId']);

            // Set it on the session
            $request->session->set('userId', $data['userId']);
            $request->session->set('userData', $member);
            return redirect('');
        } catch (\Exception $e) {
            return redirect('login?error=2');
        }
    }

    public function setNewPassword(Request $request)
    {
        return view('login.new_password');
    }

    public function processNewPassword(Request $request, $id)
    {
        $pincode = $request->pincode;
        if (!isset($pincode)) {
            return redirect('login?error=3');
        }

        $needsReplacing = $this->client->hasToSetPassword($id);
        if (!$needsReplacing) {
            return redirect('login?error=3');
        }

        $bool = $this->client->setNewPassword($id, $pincode);
        if ($bool) {
            return redirect('login?error=4');
        } else {
            return redirect('login?error=2');
        }
    }

    public function logout(Request $request)
    {
        $session = $request->session;
        $session->destroy();
        return redirect('login');
    }
}
