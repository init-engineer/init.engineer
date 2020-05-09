<?php

namespace App\Http\Controllers\Frontend\OAuth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\OAuth\Clients;
use App\Http\Controllers\Controller;

/**
 * Class CallbackController.
 */
class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        $http = new Client();
        $client = Clients::find($request->client_id);
        $response = $http->post('/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'redirect_uri' => $client->redirect,
                'code' => $request->code,
            ],
        ]);

        return response()->json(json_decode((string) $response->getBody(), true));
    }
}
