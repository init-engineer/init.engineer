<?php

/**
 * This is a custom implementation of League\Fractal\Pagination\IlluminatePaginatorAdapter
 *
 * As of March 2019 Fractal doesn't have a paginator for Laravel simplePaginate()
 */

namespace App\Http\Transformers;

use Illuminate\Contracts\Pagination\Paginator;
use League\Fractal\Pagination\PaginatorInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * A paginator adapter for illuminate/pagination.
 *
 * @author Danny Herran <me@dannyherran.com>
 */
class IlluminatePaginatorAdapter implements PaginatorInterface
{
    /**
     * The paginator instance.
     *
     * @var \Illuminate\Contracts\Pagination\Paginator
     */
    protected $paginator;

    /**
     * Create a new illuminate pagination adapter.
     *
     * @param \Illuminate\Contracts\Pagination\Paginator $paginator
     *
     * @return void
     */
    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Get the current page.
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->paginator->currentPage();
    }

    /**
     * Get the last page.
     *
     * @return int
     */
    public function getLastPage()
    {
        return $this->paginator->hasMorePages() ? $this->getCurrentPage() + 1 : $this->getCurrentPage();
    }

    /**
     * Get the total.
     *
     * @return int
     */
    public function getTotal()
    {
        return null;
    }

    /**
     * Get the count.
     *
     * @return int
     */
    public function getCount()
    {
        return $this->paginator->count();
    }

    /**
     * Get the number per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return $this->paginator->perPage();
    }

    /**
     * Get the url for the given page.
     *
     * @param int $page
     *
     * @return string
     */
    public function getUrl($page)
    {
        return $this->paginator->url($page);
    }

    /**
     * Get the paginator instance.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }
}
