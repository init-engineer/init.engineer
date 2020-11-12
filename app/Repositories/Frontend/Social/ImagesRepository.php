<?php

namespace App\Repositories\Frontend\Social;

use App\Exceptions\GeneralException;
use App\Models\Social\Images;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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
     * @param array $data
     *
     * @throws GeneralException
     * @return Images
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $images = $this->model::create(array(
                'card_id' => $data['card_id'],
                'storage' => $data['storage'] ?? 'storage',
                'path' => $data['avatar']['path'],
                'name' => $data['avatar']['name'],
                'type' => $data['avatar']['type'],
                'active' => true,
            ));

            if ($images) {
                // event(new ImagesCreated($images));

                return $images;
            }

            throw new GeneralException(__('exceptions.frontend.social.images.create_error'));
        });
    }
}
