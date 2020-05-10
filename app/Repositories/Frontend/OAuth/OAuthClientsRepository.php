<?php

namespace App\Repositories\Frontend\OAuth;

use App\Models\OAuth\Clients;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;

/**
 * Class OAuthClientsRepository.
 */
class OAuthClientsRepository extends BaseRepository
{
    /**
     * OAuthClientsRepository constructor.
     *
     * @param Clients $model
     */
    public function __construct(Clients $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findById($id)
    {
        $clients = $this->model
            ->find($id);

        if ($clients instanceof $this->model) {
            return $clients;
        }

        // throw new GeneralException(__('exceptions.frontend.oauth.clients.not_found'));
        return false;
    }

    /**
     * @param Clients $ads
     * @param array   $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Clients
     */
    public function update(Clients $clients, array $data) : Clients
    {
        return DB::transaction(function () use ($clients, $data) {
            if ($clients->update([
                'name'     => $data['name']     ?? $clients->name,
                'redirect' => $data['redirect'] ?? $clients->redirect,
            ])) {
                // event(new OAuthClientsUpdated($clients));

                return $clients;
            }

            throw new GeneralException(__('exceptions.frontend.oauth.clients.update_error'));
        });
    }
}
