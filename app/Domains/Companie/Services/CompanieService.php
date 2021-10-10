<?php

namespace App\Domains\Companie\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Companie\Models\Companies;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CompanieService.
 */
class CompanieService extends BaseService
{
    /**
     * CompanieService constructor.
     *
     * @param Companies $companies
     */
    public function __construct(Companies $companies)
    {
        $this->model = $companies;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerCompanie(array $data = []): Companies
    {
        DB::beginTransaction();

        try {
            $companie = $this->createCompanie($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your companie.'));
        }

        DB::commit();

        return $companie;
    }

    /**
     * @param array $data
     *
     * @return Companies
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Companies
    {
        DB::beginTransaction();

        try {
            $companie = $this->createCompanie([
                'model_id' => $data['model_id'],
                'name' => $data['name'],
                'description' => $data['description'],
                'content' => $data['content'],
                'scale' => $data['scale'],
                'picture' => $data['picture'],
                'active' => false,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this companie. Please try again.'));
        }

        // event(new CompanieCreated($companie));

        DB::commit();

        return $companie;
    }

    /**
     * @param Companies $companie
     * @param array $data
     *
     * @return Companies
     * @throws \Throwable
     */
    public function update(Companies $companie, array $data = []): Companies
    {
        DB::beginTransaction();

        try {
            $companie->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'content' => $data['content'],
                'scale' => $data['scale'],
                'picture' => $data['picture'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this companie. Please try again.'));
        }

        // event(new CompanieUpdated($companie));

        DB::commit();

        return $companie;
    }

    /**
     * @param Companies $companie
     * @param User $user
     * @param string
     *
     * @return Companies
     * @throws GeneralException
     */
    public function blockade(Companies $companie, User $user, string $remarks): Companies
    {
        DB::beginTransaction();

        try {
            $companie->update([
                'blockade' => true,
                'blockade_by' => $user->id,
                'blockade_remarks' => $remarks ?? null,
                'blockade_at' => Carbon::now(),
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem blocking this companie. Please try again.'));
        }

        // event(new CompanieBlockaded($companie, $user, $remarks));

        DB::commit();

        return $companie;
    }

    /**
     * @param Companies $companie
     * @param $status
     *
     * @return Companies
     * @throws GeneralException
     */
    public function mark(Companies $companie, $status): Companies
    {
        $companie->active = $status;

        if ($companie->save()) {
            // event(new CompanieStatusChanged($companie, $status));

            return $companie;
        }

        throw new GeneralException(__('There was a problem updating this companie. Please try again.'));
    }

    /**
     * @param Companies $companie
     *
     * @return Companies
     * @throws GeneralException
     */
    public function delete(Companies $companie): Companies
    {
        if ($this->deleteById($companie->id)) {
            // event(new CompanieDeleted($companie));

            return $companie;
        }

        throw new GeneralException('There was a problem deleting this companie. Please try again.');
    }

    /**
     * @param Companies $companie
     *
     * @throws GeneralException
     * @return Companies
     */
    public function restore(Companies $companie): Companies
    {
        if ($companie->restore()) {
            // event(new CompanieRestored($companie));

            return $companie;
        }

        throw new GeneralException(__('There was a problem restoring this companie. Please try again.'));
    }

    /**
     * @param Companies $companie
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Companies $companie): bool
    {
        if ($companie->forceDelete()) {
            // event(new CompaniesDestroyed($companie));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this companie. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return Companies
     */
    protected function createCompanie(array $data = []): Companies
    {
        return $this->model::create([
            'model_type' => User::class,
            'model_id' => $data['model_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => $data['content'],
            'scale' => $data['scale'] ?? 1,
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
    protected function createImage(array $data = []): array
    {
        return array(
            'local' => $data['local'] ?? null,
            'storage' => $data['storage'] ?? null,
            'imgur' => $data['imgur'] ?? null,
        );
    }
}
