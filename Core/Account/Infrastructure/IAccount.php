<?php

namespace Core\Account\Infrastructure;

use Illuminate\Http\Request;


interface IAccount
{
    public function register(Request $request);

    public function login(Request $request);

    public function userProfile();

    public function logout();
}
