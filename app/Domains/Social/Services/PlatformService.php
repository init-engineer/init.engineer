<?php

namespace App\Domains\Social\Services;

use App\Domains\Social\Models\Platform;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class PlatformService.
 */
class PlatformService extends BaseService
{
    /**
     * PlatformService constructor.
     *
     * @param Platform $platform
     */
    public function __construct(Platform $platform)
    {
        $this->model = $platform;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerPlatform(array $data = []): Platform
    {
        DB::beginTransaction();

        try {
            $platform = $this->createPlatform($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your platform.'));
        }

        DB::commit();

        return $platform;
    }

    /**
     * @param array $data
     *
     * @return Platform
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Platform
    {
        DB::beginTransaction();

        try {
            $config = $this->createConfig($data);
            $platform = $this->createPlatform([
                'name' => $data['platformName'],
                'type' => $data['platformType'],
                'active' => $data['active'],
                'config' => $config,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this platform. Please try again.'));
        }

        // event(new PlatformCreated($platform));

        DB::commit();

        return $platform;
    }

    /**
     * @param Platform $platform
     * @param array $data
     *
     * @return Platform
     * @throws \Throwable
     */
    public function update(Platform $platform, array $data = []): Platform
    {
        DB::beginTransaction();

        try {
            $config = $this->createConfig($data);
            $platform->update([
                'name' => $data['platformName'] ?? $platform->name,
                'type' => $data['platformType'] ?? $platform->type,
                'config' => $config,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this platform. Please try again.'));
        }

        // event(new PlatformUpdated($platform));

        DB::commit();

        return $platform;
    }

    /**
     * @param Platform $platform
     * @param $status
     *
     * @return Platform
     * @throws GeneralException
     */
    public function mark(Platform $platform, $status): Platform
    {
        $platform->active = $status;

        if ($platform->save()) {
            // event(new PlatformStatusChanged($platform, $status));

            return $platform;
        }

        throw new GeneralException(__('There was a problem updating this platform. Please try again.'));
    }

    /**
     * @param Platform $platform
     *
     * @return Platform
     * @throws GeneralException
     */
    public function delete(Platform $platform): Platform
    {
        if ($this->deleteById($platform->id)) {
            // event(new PlatformDeleted($platform));

            return $platform;
        }

        throw new GeneralException('There was a problem deleting this platform. Please try again.');
    }

    /**
     * @param Platform $platform
     *
     * @throws GeneralException
     * @return Platform
     */
    public function restore(Platform $platform): Platform
    {
        if ($platform->restore()) {
            // event(new PlatformRestored($platform));

            return $platform;
        }

        throw new GeneralException(__('There was a problem restoring this platform. Please try again.'));
    }

    /**
     * @param Platform $platform
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Platform $platform): bool
    {
        if ($platform->forceDelete()) {
            // event(new PlatformDestroyed($platform));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this platform. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function createConfig(array $data): array
    {
        switch ($data['platformType']) {
            case Platform::TYPE_FACEBOOK:
                $config = [
                    'user_id' => $data['user_id'],
                    'app_id' => $data['app_id'],
                    'app_secret' => $data['app_secret'],
                    'graph_version' => $data['graph_version'],
                    'access_token' => $data['access_token'],
                    'pages_name' => $data['pages_name'],
                ];
                break;

            case Platform::TYPE_TWITTER:
                $config = [
                    'consumer_key' => $data['consumer_key'],
                    'consumer_secret' => $data['consumer_secret'],
                    'access_token' => $data['access_token'],
                    'access_token_secret' => $data['access_token_secret'],
                    'pages_name' => $data['pages_name'],
                ];
                break;

            case Platform::TYPE_PLURK:
                $config = [
                    'client_id' => $data['client_id'],
                    'client_secret' => $data['client_secret'],
                    'token' => $data['token'],
                    'token_secret' => $data['token_secret'],
                    'pages_name' => $data['pages_name'],
                ];
                break;

            default:
                $config = [];
                break;
        }

        return $config;
    }


    /**
     * @param array $data
     *
     * @return Platform
     */
    protected function createPlatform(array $data = []): Platform
    {
        return $this->model::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'active' => $data['active'],
            'config' => json_encode($data['config']),
        ]);
    }
}
