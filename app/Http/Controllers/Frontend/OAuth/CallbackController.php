<?php

namespace App\Http\Controllers\Frontend\OAuth;

use GuzzleHttp\Client;
use App\Models\OAuth\Clients;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\OAuth\OAuthClientsRepository;
use App\Http\Requests\Frontend\OAuth\ClientCallbackTestingRequest;

/**
 * Class CallbackController.
 */
class CallbackController extends Controller
{
    /**
     * @var OAuthClientsRepository
     */
    protected $clientsRepository;

    /**
     * CallbackController constructor.
     *
     * @param OAuthClientsRepository $clientsRepository
     */
    public function __construct(OAuthClientsRepository $clientsRepository)
    {
        $this->clientsRepository = $clientsRepository;
    }

    /**
     * @param ClientCallbackTestingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(ClientCallbackTestingRequest $request)
    {
        $testing_client_id = $request->session()->get('testing_client_id');
        $testing_redirect_uri = $request->session()->get('testing_redirect_uri');
        $client = Clients::find($testing_client_id);

        $http = new Client();
        $response = $http->post(config('app.url') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'redirect_uri' => $client->redirect,
                'code' => $request->code,
            ],
        ]);

        $this->clientsRepository->update($client, ['redirect' => $testing_redirect_uri]);

        $request->session()->forget('testing_client_id');
        $request->session()->forget('testing_redirect_uri');

        return response()->json(json_decode((string) $response->getBody(), true));
    }
}
