<?php

namespace App\Repositories\Backend\News;

use App\Models\Auth\User;
use App\Models\News\News;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class NewsRepository.
 */
class NewsRepository extends BaseRepository
{
    /**
     * NewsRepository constructor.
     *
     * @param News $model
     */
    public function __construct(News $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $url
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByUrl(string $url)
    {
        $news = $this->model
            ->where('url', $url)
            ->first();

        if ($news instanceof $this->model) {
            return $news;
        }

        throw new GeneralException(__('exceptions.backend.news.not_found'));
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return News
     */
    public function create(array $data) : News
    {
        return DB::transaction(function () use ($data)
        {
            $news = $this->model::create([
                'model_type' => User::class,
                'model_id' => $data['model_id'],
                'title' => $data['title'],
                'image' => $data['image'],
                'content' => $data['content'],
                'url' => $data['url'],
                'hashtag' => $data['hashtag'],
                'layout' => isset($data['layout'])? $data['layout'] : 'frontend.news.layout.default',
                'active' => isset($data['active']) && $data['active'] === '1',
            ]);

            if ($news)
            {
                // event(new NewsCreated($news));

                return $news;
            }

            throw new GeneralException(__('exceptions.backend.news.create_error'));
        });
    }

    /**
     * @param News $news
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return News
     */
    public function update(News $news, array $data) : News
    {
        return DB::transaction(function () use ($news, $data)
        {
            if ($news->update([
                'title' => isset($data['title'])? $data['title'] : $news->title,
                'image' => isset($data['image'])? $data['image'] : $news->image,
                'content' => isset($data['content'])? $data['content'] : $news->content,
                'url' => isset($data['url'])? $data['url'] : $news->url,
                'hashtag' => isset($data['hashtag'])? $data['hashtag'] : $news->hashtag,
                'layout' => isset($data['layout'])? $data['layout'] : $news->layout,
            ]))
            {
                // event(new NewsUpdated($news));

                return $news;
            }

            throw new GeneralException(__('exceptions.backend.news.update_error'));
        });
    }

    /**
     * @param News $news
     * @param      $status
     *
     * @throws GeneralException
     * @return News
     */
    public function mark(News $news, $status) : News
    {
        $news->active = $status;

        // switch ($status)
        // {
        //     case 0:
        //         event(new NewsDeactivated($news));
        //     break;
        //     case 1:
        //         event(new NewsReactivated($news));
        //     break;
        // }

        if ($news->save()) {
            return $news;
        }

        throw new GeneralException(__('exceptions.backend.news.mark_error'));
    }

    /**
     * @param News $news
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return News
     */
    public function forceDelete(News $news) : News
    {
        if ($news->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.news.delete_first'));
        }

        return DB::transaction(function () use ($news)
        {
            if ($news->forceDelete()) {
                // event(new NewsPermanentlyDeleted($news));

                return $news;
            }

            throw new GeneralException(__('exceptions.backend.news.delete_error'));
        });
    }

    /**
     * @param News $news
     *
     * @throws GeneralException
     * @return News
     */
    public function restore(News $news) : News
    {
        if ($news->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.news.cant_restore'));
        }

        if ($news->restore()) {
            // event(new NewsRestored($news));

            return $news;
        }

        throw new GeneralException(__('exceptions.backend.news.restore_error'));
    }
}
