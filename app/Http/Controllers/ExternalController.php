<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExternalController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://reqres.in',
            'timeout'  => 2.0,
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        try {
            $response = $this->client->request('POST', '/api/register', [
                'form_params' => [
                    'email' => $request->get('email'),
                    'password' => $request->get('password'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return response()->json($data, $response->getStatusCode());
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $response = $this->client->request('POST', '/api/login', [
                'form_params' => [
                    'email' => $request->get('email'),
                    'password' => $request->get('password'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return response()->json($data, $response->getStatusCode());
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
