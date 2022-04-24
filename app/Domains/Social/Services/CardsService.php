<?php

namespace App\Domains\Social\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Cards;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class CardsService.
 *
 * @extends BaseService
 */
class CardsService extends BaseService
{
    /**
     * CardsService constructor.
     *
     * @param Cards $cards
     */
    public function __construct(Cards $cards)
    {
        $this->model = $cards;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerCards(array $data = []): Cards
    {
        DB::beginTransaction();

        try {
            $cards = $this->createCards($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your cards.'));
        }

        DB::commit();

        return $cards;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginated($paged = 25, $orderBy = 'updated_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active(false)
            ->blockade(false)
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
    public function getActivePaginated($paged = 25, $orderBy = 'updated_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active()
            ->publish()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Cards
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Cards
    {
        DB::beginTransaction();

        try {
            $cards = $this->createCards([
                'model_id' => $data['model_id'],
                'content' => $data['content'],
                'config' => $data['config'],
                'picture' => $data['picture'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this cards. Please try again.'));
        }

        // event(new CardsCreated($cards));

        DB::commit();

        return $cards;
    }

    /**
     * @param Cards $cards
     * @param array $data
     *
     * @return Cards
     * @throws \Throwable
     */
    public function update(Cards $cards, array $data = []): Cards
    {
        DB::beginTransaction();

        try {
            $cards->update([
                'content' => $data['content'],
                'config' => $data['config'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this cards. Please try again.'));
        }

        // event(new CardsUpdated($cards));

        DB::commit();

        return $cards;
    }

    /**
     * @param Cards $cards
     * @param User $user
     * @param string
     *
     * @return Cards
     * @throws GeneralException
     */
    public function blockade(Cards $cards, User $user, string $remarks): Cards
    {
        DB::beginTransaction();

        try {
            $cards->update([
                'blockade' => true,
                'blockade_by' => $user->id,
                'blockade_remarks' => $remarks ?? null,
                'blockade_at' => Carbon::now(),
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem blocking this cards. Please try again.'));
        }

        // event(new CardsBlockaded($cards, $user, $remarks));

        DB::commit();

        return $cards;
    }

    /**
     * @param Cards $cards
     * @param $status
     *
     * @return Cards
     * @throws GeneralException
     */
    public function mark(Cards $cards, $status): Cards
    {
        $cards->active = $status;

        if ($cards->save()) {
            // event(new CardsStatusChanged($cards, $status));

            return $cards;
        }

        throw new GeneralException(__('There was a problem updating this cards. Please try again.'));
    }

    /**
     * @param Cards $cards
     *
     * @return Cards
     * @throws GeneralException
     */
    public function delete(Cards $cards): Cards
    {
        if ($this->deleteById($cards->id)) {
            // event(new CardsDeleted($cards));

            return $cards;
        }

        throw new GeneralException('There was a problem deleting this cards. Please try again.');
    }

    /**
     * @param Cards $cards
     *
     * @throws GeneralException
     * @return Cards
     */
    public function restore(Cards $cards): Cards
    {
        if ($cards->restore()) {
            // event(new CardsRestored($cards));

            return $cards;
        }

        throw new GeneralException(__('There was a problem restoring this cards. Please try again.'));
    }

    /**
     * @param Cards $cards
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Cards $cards): bool
    {
        if ($cards->forceDelete()) {
            // event(new CardsDestroyed($cards));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this cards. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return Cards
     */
    protected function createCards(array $data = []): Cards
    {
        return $this->model::create([
            'model_type' => User::class,
            'model_id' => $data['model_id'],
            'content' => $data['content'],
            'config' => $this->createConfig($data['config']),
            'picture' => $this->createImage($data['picture']),
            'active' => $data['active'] ?? false,
            'blockade' => $data['blockade'] ?? false,
        ]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createConfig(array $data = []): array
    {
        return [
            'type' => $data['type'],
            'theme' => $data['theme'] ?? null,
            'font' => $data['font'] ?? null,
            'ads' => $data['ads'] ?? null,
        ];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createImage(array $data = []): array
    {
        return [
            'local' => $data['local'] ?? null,
            'storage' => $data['storage'] ?? null,
            'imgur' => $data['imgur'] ?? null,
        ];
    }
}
