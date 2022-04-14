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
                'logo' => $data['logo'] ?? null,
                'banner' => $data['banner'] ?? null,
                'pictures' => $data['pictures'] ?? [],
                'area' => $data['area'] ?? null,
                'address' => $data['address'],
                'scale' => $data['scale'] ?? null,
                'tax' => $data['tax'] ?? null,
                'capital' => $data['capital'] ?? null,
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'description' => $data['description'] ?? null,
                'content' => $data['contents'] ?? [],
                'active' => true,
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
                'model_id' => $data['model_id'],
                'name' => $data['name'],
                'logo' => $data['logo'],
                'banner' => $data['banner'],
                'pictures' => $data['pictures'],
                'area' => $data['area'],
                'address' => $data['address'],
                'scale' => $data['scale'],
                'tax' => $data['tax'],
                'capital' => $data['capital'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'description' => $data['description'],
                'content' => $data['content'],
                'active' => true,
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
            'logo' => $this->createLogo($data['logo'] ?? []),
            'banner' => $this->createBanner($data['banner'] ?? []),
            'pictures' => $this->createPictures($data['pictures'] ?? []),
            'area' => $data['area'],
            'address' => $data['address'],
            'scale' => $data['scale'] ?? null,
            'tax' => $data['tax'] ?? null,
            'capital' => $data['capital'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'description' => $data['description'] ?? '我們沒有任何簡介 :)',
            'content' => $data['content'] ?? [],
            'active' => $data['active'] ?? true,
            'blockade' => $data['blockade'] ?? false,
        ]);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createLogo(array $data = []): array
    {
        return [
            'local' => $data['local'] ?? null,
            'storage' => $data['storage'] ?? null,
            'imgur' => $data['imgur'] ?? null,
        ];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createBanner(array $data = []): array
    {
        return [
            'local' => $data['local'] ?? null,
            'storage' => $data['storage'] ?? null,
            'imgur' => $data['imgur'] ?? null,
        ];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createPictures(array $data = []): array
    {
        $result = [];
        foreach ($data as $picture) {
            array_push($result, [
                'local' => $picture['local'] ?? null,
                'storage' => $picture['storage'] ?? null,
                'imgur' => $picture['imgur'] ?? null,
            ]);
        }

        return $result;
    }
}
