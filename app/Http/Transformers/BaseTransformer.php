<?php

namespace App\Http\Transformers;

// use MongoDB\Model\BSONArray;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as PaginatorContract;

/**
 * Class Transformer
 */
abstract class BaseTransformer implements TransformerContract
{
    /**
     * Transform a single item.
     *
     * @param  mixed $item
     * @return array
     */
    abstract public function transformItem($item);

    /**
     * Transform the data using one of the transformers available.
     *
     * @param  mixed $data
     * @return mixed
     */
    public function transform($data)
    {
        if ($data instanceof PaginatorContract)
        {
            return $this->transformPaginator($data);
        }
        if ($data instanceof Collection)
        {
            return $this->transformCollection($data);
        }
        // if ($data instanceof BSONArray)
        // {
        //     $data = iterator_to_array($data);
        // }
        if (is_array($data))
        {
            return $this->transformArray($data);
        }
        return $this->transformItem($data);
    }

    /**
     * Transform the paginator data and return a new paginator instance.
     *
     * @param  LengthAwarePaginator $paginator
     * @return LenghtAwarePaginator
     */
    private function transformPaginator(LengthAwarePaginator $paginator)
    {
        $items = array_map([$this, 'transformItem'], $paginator->items());
        return new LengthAwarePaginator(
            $items,
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $paginator->getPageName()
            ]
        );
    }

    /**
     * Transform a collection data and return a new collection.
     *
     * @param  Collection $collection
     * @return Collection
     */
    private function transformCollection(Collection $collection)
    {
        $items = array_map([$this, 'transformItem'], $collection->all());
        return collect($items);
    }

    /**
     * Transforms a simple array
     *
     * @param  array  $data
     * @return array
     */
    private function transformArray(array $data)
    {
        return array_map([$this, 'transformItem'], $data);
    }

    /**
     * Transform the data into a CSV string.
     *
     * @param  mixed $data
     * @return string
     */
    public function toCsv($data)
    {
        $transformed = $this->transform($data);
        if ($data instanceof PaginatorContract)
        {
            $transformed = $transformed->items();
        }
        if ($data instanceof Collection)
        {
            $transformed = $transformed->all();
        }
        if (!count($transformed))
        {
            return [];
        }
        ob_start();
        $handler = fopen("php://output", 'w');
        fputcsv($handler, array_keys(reset($transformed))); //putting the headers in the csv
        foreach ($transformed as $item)
        {
            fputcsv($handler, $item);
        }
        fclose($handler);
        return ob_get_clean();
    }
}
