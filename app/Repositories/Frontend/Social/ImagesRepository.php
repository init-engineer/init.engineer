<?php

namespace App\Repositories\Frontend\Social;

use App\Models\Social\Images;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;

/**
 * Class ImagesRepository.
 */
class ImagesRepository extends BaseRepository
{
    /**
     * ImagesRepository constructor.
     *
     * @param Images $model
     */
    public function __construct(Images $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findById($id)
    {
        $image = $this->model
            ->find($id);

        if ($image instanceof $this->model) {
            return $image;
        }

        throw new GeneralException(__('exceptions.frontend.social.images.not_found'));
    }

    /**
     * @param $id
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByCardId($id)
    {
        $image = $this->model
            ->where('card_id', $id)
            ->first();

        if ($image instanceof $this->model) {
            return $image;
        }

        throw new GeneralException(__('exceptions.frontend.social.images.not_found'));
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Images
     */
    public function create(array $data) : Images
    {
        return DB::transaction(function () use ($data) {
            $image = $this->model::create([
                'card_id' => $data['card_id'],
                'model_type' => isset($data['user_type'])? $data['user_type'] : 'App\Models\Auth\User',
                'model_id' => $data['user_id'],
                'storage' => isset($data['avatar']['storage'])? $data['avatar']['storage'] : 'storage',
                'avatar_path' => $data['avatar']['path'],
                'avatar_name' => $data['avatar']['name'],
                'avatar_type' => $data['avatar']['type'],
                'imgur_url' => isset($data['avatar']['imgur_url'])? $data['avatar']['imgur_url'] : null,
            ]);

            if ($image) {
                // event(new ImagesCreated($image));

                return $image;
            }

            throw new GeneralException(__('exceptions.frontend.social.images.create_error'));
        });
    }

    /**
     * @param Images $images
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Images
     */
    public function update(Images $images, array $data) : Images
    {
        return DB::transaction(function () use ($images, $data) {
            if ($images->update([
                'storage' => isset($data['avatar']['storage'])? $data['avatar']['storage'] : $images->storage,
                'avatar_path' => isset($data['avatar']['path'])? $data['avatar']['path'] : $images->avatar_path,
                'avatar_name' => isset($data['avatar']['name'])? $data['avatar']['name'] : $images->avatar_name,
                'avatar_type' => isset($data['avatar']['type'])? $data['avatar']['type'] : $images->avatar_type,
                'imgur_url' => isset($data['avatar']['imgur_url'])? $data['avatar']['imgur_url'] : $images->imgur_url,
            ])) {
                // event(new ImagesUpdated($images));

                return $images;
            }

            throw new GeneralException(__('exceptions.frontend.social.images.update_error'));
        });
    }
}
