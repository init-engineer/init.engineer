<?php

namespace App\Domains\Social\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Companie\Models\CompanieJobs;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CompanieJobService.
 */
class CompanieJobService extends BaseService
{
    /**
     * CompanieJobService constructor.
     *
     * @param CompanieJobs $companieJobs
     */
    public function __construct(CompanieJobs $companieJobs)
    {
        $this->model = $companieJobs;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerCompanieJob(array $data = []): CompanieJobs
    {
        DB::beginTransaction();

        try {
            $companieJobs = $this->createCompanieJob($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your job.'));
        }

        DB::commit();

        return $companieJobs;
    }

    /**
     * @param array $data
     *
     * @return CompanieJobs
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): CompanieJobs
    {
        DB::beginTransaction();

        try {
            $companieJob = $this->createCompanieJob([
                'model_id' => $data['model_id'],
                'content' => $data['content'],
                'config' => $data['config'],
                'picture' => $data['picture'],
                'model_type',
                'model_id',
                'companie_id',
                'name',
                'type',
                'content',
                'pay',
                'active',
                'blockade',
                'blockade_by',
                'blockade_remarks',
                'blockade_at',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this job. Please try again.'));
        }

        // event(new CompanieJobCreated($companieJob));

        DB::commit();

        return $companieJob;
    }

    /**
     * @param CompanieJobs $companieJob
     * @param array $data
     *
     * @return CompanieJobs
     * @throws \Throwable
     */
    public function update(CompanieJobs $companieJob, array $data = []): CompanieJobs
    {
        DB::beginTransaction();

        try {
            $companieJob->update([
                'content' => $data['content'],
                'config' => $data['config'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this cards. Please try again.'));
        }

        // event(new CardsUpdated($cards));

        DB::commit();

        return $companieJob;
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
     * @return CompanieJobs
     */
    protected function createCompanieJob(array $data = []): CompanieJobs
    {
        return $this->model::create([
            'model_type' => User::class,
            'model_id' => $data['model_id'],
            'companie_id' => $data['companie_id'],
            'name' => $data['name'],
            'type' => $data['type'],
            'content' => $data['content'],
            'pay' => $this->createPay($data['pay']),
            'active' => $data['active'] ?? false,
            'blockade' => $data['blockade'] ?? false,
        ]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createPay(array $data = []): array
    {
        return array(
            // 支薪方式
            'type' => $data['type'],
            // 薪資範圍
            'amount' => array(
                // 薪水最低
                'min' => $data['amount']['min'],
                // 薪水最高
                'max' => $data['amount']['max'],
            ),
        );
    }
}
