<?php

namespace App\Repositories\Frontend\Social;

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
    public function getActivePaginated($paged = 10, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active()
            ->publish()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param User   $user
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getDashboardPaginated(User $user, $paged = 10, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->where('model_id', $user->id)
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

        // throw new GeneralException(__('exceptions.frontend.social.cards.not_found'));
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
                'model_type' => isset($data['model_type'])? $data['model_type'] : 'App\Models\Auth\User',
                'model_id' => $data['model_id'],
                'content' => $data['content'],
            ]);

            if ($cards) {
                // event(new CardsCreated($cards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.frontend.social.cards.create_error'));
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
            ])) {
                // event(new CardsUpdated($mediaCards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.frontend.social.cards.update_error'));
        });
    }
}
