<?php

namespace App\Repositories\Backend\Social;

use App\Models\Auth\User;
use App\Models\Social\Cards;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CardsRepository.
 */
class CardsRepository extends BaseRepository
{
    /**
     * CardsRepository constructor.
     *
     * @param Cards $model
     */
    public function __construct(Cards $model)
    {
        $this->model = $model;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active()
            ->publish()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active(false)
            ->banned()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param $id
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findById($id)
    {
        $cards = $this->model
            ->find($id);

        if ($cards instanceof $this->model) {
            return $cards;
        }

        // throw new GeneralException(__('exceptions.backend.social.cards.not_found'));
        return false;
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Cards
     */
    public function create(array $data) : Cards
    {
        return DB::transaction(function () use ($data) {
            $cards = $this->model::create([
                'id' => isset($data['id'])? $data['id'] : null,
                'model_type' => isset($data['model_type'])? $data['model_type'] : 'App\Models\Auth\User',
                'model_id' => $data['model_id'],
                'content' => $data['content'],
                'active' => isset($data['active'])? $data['active'] : true,
            ]);

            if ($cards) {
                // event(new CardsCreated($cards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.backend.social.cards.create_error'));
        });
    }

    /**
     * @param Cards $cards
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Cards
     */
    public function update(Cards $cards, array $data) : Cards
    {
        return DB::transaction(function () use ($cards, $data) {
            if ($cards->update([
                'content' => isset($data['content'])? $data['content'] : $cards->content,
                'active' => isset($data['active'])? $data['active'] : $cards->active,
                'is_banned' => isset($data['is_banned'])? $data['is_banned'] : $cards->is_banned,
                'banned_user_id' => isset($data['banned_user_id'])? $data['banned_user_id'] : $cards->banned_user_id,
                'banned_remarks' => isset($data['banned_remarks'])? $data['banned_remarks'] : $cards->banned_remarks,
                'banned_at' => isset($data['banned_at'])? $data['banned_at'] : $cards->banned_at,
            ])) {
                // event(new CardsUpdated($mediaCards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.backend.social.cards.update_error'));
        });
    }

    /**
     * @param User  $user
     * @param Cards $cards
     * @param array $options
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Cards
     */
    public function banned(User $user, Cards $cards, array $options) : Cards
    {
        if ($cards->banned_at !== null) {
            throw new GeneralException(__('exceptions.backend.social.cards.banned_first'));
        }

        return DB::transaction(function () use ($user, $cards, $options) {
            if ($cards->update([
                'active' => false,
                'is_banned' => true,
                'banned_user_id' => $user->id,
                'banned_remarks' => isset($options['remarks'])? $options['remarks'] : null,
                'banned_at' => now(),
            ])) {
                // event(new CardsBanned($cards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.backend.social.cards.banned_error'));
        });
    }

    /**
     * @param Cards $cards
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Cards
     */
    public function forceDelete(Cards $cards) : Cards
    {
        if ($cards->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.social.cards.delete_first'));
        }

        return DB::transaction(function () use ($cards) {
            if ($cards->forceDelete()) {
                // event(new CardsPermanentlyDeleted($cards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.backend.social.cards.delete_error'));
        });
    }

    /**
     * @param Cards $cards
     *
     * @throws GeneralException
     * @return Cards
     */
    public function restore(Cards $cards) : Cards
    {
        if ($cards->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.social.cards.cant_restore'));
        }

        if ($cards->restore()) {
            // event(new CardsRestored($cards));

            return $cards;
        }

        throw new GeneralException(__('exceptions.backend.social.cards.restore_error'));
    }
}
