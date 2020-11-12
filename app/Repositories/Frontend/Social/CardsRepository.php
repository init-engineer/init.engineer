<?php

namespace App\Repositories\Frontend\Social;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Social\Cards;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
    public function getActivePaginated($paged = 10, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
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
     * @return mixed
     */
    public function getUnactivePaginated($paged = 10, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->active(false)
            ->banned(false)
            ->where('created_at', '>=', Carbon::now()->addDay(-7))
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
    public function getDashboardPaginated(User $user, $paged = 10, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->where('model_id', $user->id)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @return Cards
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $cards = $this->model::create(array(
                'model_type' => User::class,
                'model_id' => $data['model_id'],
                'content' => $data['content'],
                'config' => json_encode($data['config']),
                'active' => false,
            ));

            if ($cards) {
                // event(new CardsCreated($cards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.frontend.social.cards.create_error'));
        });
    }
}
