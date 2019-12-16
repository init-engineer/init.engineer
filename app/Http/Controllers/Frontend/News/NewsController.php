<?php

namespace App\Http\Controllers\Frontend\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\News\NewsRepository;

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
        return redirect()->route('frontend.index');
        // return view('frontend.news.index')
        //     ->withNews($this->newsRepository->getActivePaginated());
    }

    /**
     * Display the specified resource.
     *
     * @param string $url
     * @return \Illuminate\Http\Response
     */
    public function show(string $url)
    {
        if ($news = $this->newsRepository->findByUrl($url))
        {
            return view('frontend.news.show')
                ->withNews($news);
        }
        else
        {
            return redirect()->route('frontend.news.index')
                ->withFlashSuccess(__('alerts.frontend.news.not_found'));
        }
    }
}
