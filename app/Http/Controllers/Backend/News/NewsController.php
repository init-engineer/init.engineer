<?php

namespace App\Http\Controllers\Backend\News;

use App\Models\News\News;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Backend\News\NewsRepository;
use App\Http\Requests\Backend\News\StoreNewsRequest;
use App\Http\Requests\Backend\News\UpdateNewsRequest;

/**
 * Class NewsController.
 */
class NewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    protected $newsRepository;

    /**
     * NewsController constructor.
     *
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.news.index')
            ->withNews($this->newsRepository->getActivePaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->only('title', 'url', 'hashtag', 'layout', 'content');
        $data['model_id'] = $request->user()->id;
        $data['image'] = $request->file('image')->store('/news', 'public');
        $this->newsRepository->create($data);

        return redirect()->route('admin.news.index')->withFlashSuccess(__('alerts.backend.news.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $id)
    {
        return view('backend.news.edit')
            ->withNews($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsRequest $request
     * @param News $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $id)
    {
        $data = $request->only('title', 'url', 'hashtag', 'layout', 'content');
        if ($request->has('image'))
        {
            Storage::disk('public')->delete($id->image);
            $data['image'] = $request->file('image')->store('/news', 'public');
        }
        $this->newsRepository->update($id, $data);

        return redirect()->route('admin.news.index')->withFlashSuccess(__('alerts.backend.news.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
