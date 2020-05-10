<?php

namespace App\Http\Controllers\Frontend\OAuth;

use App\Models\OAuth\Clients;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\OAuth\OAuthClientsRepository;
use App\Http\Requests\Frontend\OAuth\ClientAuthorizeTestingRequest;

/**
 * Class AuthorizeController.
 */
class AuthorizeController extends Controller
{
    /**
     * @var OAuthClientsRepository
     */
    protected $clientsRepository;

    /**
     * AuthorizeController constructor.
     *
     * @param OAuthClientsRepository $clientsRepository
     */
    public function __construct(OAuthClientsRepository $clientsRepository)
    {
        $this->clientsRepository = $clientsRepository;
    }

    /**
     * @param ClientAuthorizeTestingRequest $request
     * @param Clients                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function authorized(ClientAuthorizeTestingRequest $request, Clients $id)
    {
        $request->session()->put('testing_client_id', $id->id);
        $request->session()->put('testing_redirect_uri', $id->redirect);

        $this->clientsRepository->update($id, ['redirect' => route('frontend.testing.oauth.callback')]);

        return redirect(config('app.url') . sprintf('/oauth/authorize?client_id=%s&redirect_uri=%s&response_type=code&scope=*', $id->id, route('frontend.testing.oauth.callback')));
    }
}
