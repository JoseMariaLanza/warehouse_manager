<?php

namespace App\Http\Controllers\SAPApi;

use App\Http\Controllers\Controller;
use ERPs\SAPInterfaces\Client\Infrastructure\IClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $client;

    public function __construct(IClient $client)
    {
        $this->client = $client;
    }

    public function login(Request $request)
    {
        return $this->client->get($request);
    }
}
