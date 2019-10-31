<?php

namespace App\Repositories\Backend\Social;

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
        $images = $this->model
            ->find($id);

        if ($images instanceof $this->model) {
            return $images;
        }

        // throw new GeneralException(__('exceptions.backend.social.images.not_found'));
        return false;
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
            $images = $this->model::create([
                'id' => isset($data['id'])? $data['id'] : null,
                'card_id' => $data['card_id'],
                'model_type' => isset($data['user_type'])? $data['user_type'] : 'App\Models\Auth\User',
                'model_id' => $data['user_id'],
                'storage' => isset($data['storage'])? $data['storage'] : 'storage',
                'avatar_path' => $data['avatar_path'],
                'avatar_name' => $data['avatar_name'],
                'avatar_type' => $data['avatar_type'],
                'imgur_url' => isset($data['imgur_url'])? $data['imgur_url'] : null,
                'active' => isset($data['active'])? $data['active'] : true,
                'is_banned' => isset($data['is_banned'])? $data['is_banned'] : false,
                'banned_user_id' => isset($data['banned_user_id'])? $data['banned_user_id'] : null,
                'banned_remarks' => isset($data['banned_remarks'])? $data['banned_remarks'] : null,
                'created_at' => isset($data['created_at'])? $data['created_at'] : null,
                'updated_at' => isset($data['updated_at'])? $data['updated_at'] : null,
                'deleted_at' => isset($data['deleted_at'])? $data['deleted_at'] : null,
            ]);

            if ($images) {
                // event(new ImagesCreated($images));

                return $images;
            }

            throw new GeneralException(__('exceptions.backend.social.images.create_error'));
        });
    }

    /**
     * @param Comments $comments
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Comments
     */
    public function update(Images $images, array $data) : Images
    {
        return DB::transaction(function () use ($images, $data) {
            if ($images->update([
                'storage' => isset($data['storage'])? $data['storage'] : $images->storage,
                'avatar_path' => isset($data['avatar_path'])? $data['avatar_path'] : $images->avatar_path,
                'avatar_name' => isset($data['avatar_name'])? $data['avatar_name'] : $images->avatar_name,
                'avatar_type' => isset($data['avatar_type'])? $data['avatar_type'] : $images->avatar_type,
                'imgur_url' => isset($data['imgur_url'])? $data['imgur_url'] : $images->imgur_url,
                'active' => isset($data['active'])? $data['active'] : $images->active,
                'is_banned' => isset($data['is_banned'])? $data['is_banned'] : $images->is_banned,
                'banned_user_id' => isset($data['banned_user_id'])? $data['banned_user_id'] : $images->banned_user_id,
                'banned_remarks' => isset($data['banned_remarks'])? $data['banned_remarks'] : $images->banned_remarks,
            ])) {
                // event(new ImagesUpdated($images));

                return $images;
            }

            throw new GeneralException(__('exceptions.backend.social.images.update_error'));
        });
    }
}
