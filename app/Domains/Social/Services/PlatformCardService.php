<?php

namespace App\Domains\Social\Services;

use App\Domains\Social\Models\PlatformCards;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class PlatformCardService.
 */
class PlatformCardService extends BaseService
{
    /**
     * PlatformCardService constructor.
     *
     * @param PlatformCards $platformCards
     */
    public function __construct(PlatformCards $platformCards)
    {
        $this->model = $platformCards;
    }

    /**
     * @param int $platform_id
     * @param int $card_id
     *
     * @return mixed
     */
    public function findPlatformCardById(int $platform_id, int $card_id)
    {
        $platformCard = $this->model
            ->where('platform_id', $platform_id)
            ->where('card_id', $card_id)
            ->first();

        if ($platformCard instanceof $this->model) {
            return $platformCard;
        }

        return false;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerPlatformCards(array $data = []): PlatformCards
    {
        DB::beginTransaction();

        try {
            $platformCards = $this->createPlatformCards($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your platform cards.'));
        }

        DB::commit();

        return $platformCards;
    }

    /**
     * @param array $data
     *
     * @return PlatformCards
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data): PlatformCards
    {
        DB::beginTransaction();

        try {
            $platformCards = $this->createPlatformCards([
                'platform_type' => $data['platform_type'],
                'platform_id' => $data['platform_id'],
                'platform_string_id' => $data['platform_string_id'],
                'platform_url' => $data['platform_url'],
                'card_id' => $data['card_id'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this platform cards. Please try again.'));
        }

        // event(new PlatformCardsCreated($platformCards));

        DB::commit();

        return $platformCards;
    }

    /**
     * @param PlatformCards $platformCards
     * @param array $data
     *
     * @return PlatformCards
     * @throws \Throwable
     */
    public function update(PlatformCards $platformCards, array $data): PlatformCards
    {
        DB::beginTransaction();

        try {
            $platformCards->update([
                'likes' => $data['likes'],
                'shares' => $data['shares'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this platform cards. Please try again.'));
        }

        // event(new PlatformCardsUpdated($platformCards));

        DB::commit();

        return $platformCards;
    }

    /**
     * @param PlatformCards $platformCards
     * @param $status
     *
     * @return PlatformCards
     * @throws GeneralException
     */
    public function mark(PlatformCards $platformCards, $status): PlatformCards
    {
        $platformCards->active = $status;

        if ($platformCards->save()) {
            // event(new PlatformCardsStatusChanged($platformCards, $status));

            return $platformCards;
        }

        throw new GeneralException(__('There was a problem updating this platform cards. Please try again.'));
    }

    /**
     * @param PlatformCards $platformCards
     *
     * @return PlatformCards
     * @throws GeneralException
     */
    public function delete(PlatformCards $platformCards): PlatformCards
    {
        if ($this->deleteById($platformCards->id)) {
            // event(new PlatformCardsDeleted($platformCards));

            return $platformCards;
        }

        throw new GeneralException('There was a problem deleting this platform cards. Please try again.');
    }

    /**
     * @param PlatformCards $platformCards
     *
     * @throws GeneralException
     * @return PlatformCards
     */
    public function restore(PlatformCards $platformCards): PlatformCards
    {
        if ($platformCards->restore()) {
            // event(new PlatformCardsRestored($platformCards));

            return $platformCards;
        }

        throw new GeneralException(__('There was a problem restoring this platform cards. Please try again.'));
    }

    /**
     * @param PlatformCards $platformCards
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(PlatformCards $platformCards): bool
    {
        if ($platformCards->forceDelete()) {
            // event(new PlatformCardsDestroyed($platformCards));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this platform cards. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return PlatformCards
     */
    protected function createPlatformCards(array $data = []): PlatformCards
    {
        return $this->model::create([
            'platform_type' => $data['platform_type'],
            'platform_id' => $data['platform_id'],
            'platform_string_id' => $data['platform_string_id'],
            'platform_url' => $data['platform_url'],
            'card_id' => $data['card_id'],
            'active' => true,
            'likes' => 0,
            'shares' => 0,
        ]);
    }
}
