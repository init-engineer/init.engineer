<?php

namespace App\Domains\Social\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Cards;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CardsService.
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
     * @param Cards $cards
     * @param array $data
     *
     * @return Cards
     */
    public function registerPlatform(Cards $cards, array $data): Cards
    {
        $platforms = $this->createPlatform($data, json_decode($cards->platform, true));
        $cards->platform = json_encode($platforms);

        if ($cards->save()) {
            // event(new CardsRegisterPlatform($cards, $data));

            return $cards;
        }

        throw new GeneralException(__('There was a problem updating this cards. Please try again.'));
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
    public function banned(Cards $cards, User $user, string $remarks): Cards
    {
        DB::beginTransaction();

        try {
            $cards->update([
                'banned' => true,
                'banned_by' => $user->id,
                'banned_remarks' => $remarks ?? null,
                'banned_at' => Carbon::now(),
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem banning this cards. Please try again.'));
        }

        // event(new CardsBanned($cards, $user, $remarks));

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
            'config' => json_encode($data['config']),
            'active' => $data['active'] ?? false,
            'banned' => $data['banned'] ?? false,
        ]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createConfig(array $data = []): array
    {
        return [];
    }

    /**
     * @param array $data
     * @param array $origin
     *
     * @return array
     */
    protected function createPlatform(array $data, array $origin = []): array
    {
        $platforms = $origin;
        array_push($platforms, [
            'platform' => [
                'id' => $data['platform']['id'],
                'name' => $data['platform']['name'],
                'type' => $data['platform']['type'],
            ],
            'post_id' => $data['post_id'],
            'like' => 0,
            'share' => 0,
            'active' => true,
            'created_at' => $data['created_at'],
            'updated_at' => Carbon::now(),
        ]);
        return $platforms;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createImage(array $data = []): array
    {
        return [
            'storage' => $data['storage'] ?? 'storage',
            'path' => $data['path'],
            'name' => $data['name'],
            'type' => $data['type'],
        ];
    }
}
