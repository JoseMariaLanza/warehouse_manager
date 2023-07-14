<?php

namespace App\Http\Controllers\Api\v1\Account;

use App\Http\Controllers\Controller;
use Core\Account\Infrastructure\IAccount;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    protected $account;

    function __construct(IAccount $account)
    {
        $this->account = $account;
    }

    public function register(Request $request)
    {
        return $this->account->register($request);
    }

    public function login(Request $request)
    {
        return $this->account->login($request);
    }

    public function userProfile()
    {
        return $this->account->userProfile();
    }

    public function logout()
    {
        return $this->account->logout();
    }
}
