<?php

namespace App\Console\Commands\Social;

use App\Models\Social\Review;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Class ReviewTop.
 */
class ReviewTop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:review-top';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '製作群眾審核排行榜的 JSON 資料。';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $result = ['data' => []];
        $reviews = Review::all()->groupBy('model_id');
        $i = 1;
        foreach ($reviews as $review) {
            $user = $review[0]->model;
            array_push($result['data'], [
                'id' => $i++,
                'name' => 'Defalut',
                'picture' => 'https://www.gravatar.com/avatar/6e4adcf002af9a4381c39fde1b75bd6c.jpg',
                // 'id' => $user->id,
                // 'name' => $user->last_name ? $user->first_name . ' ' . $user->last_name : $user->first_name,
                // 'picture' => $user->getPicture(),
                'count' => $review->count(),
            ]);
        }
        $result['data'] = $this->sksort($result['data'], 'count');

        File::put('public/json/social/reviewTop.json', json_encode($result));
    }

    /**
     * @param array   $array
     * @param string  $subkey
     * @param boolean $sort_ascending
     *
     * @return array
     */
    private function sksort(array $array, $subkey = 'id', $sort_ascending = false): array
    {
        if (count($array)) $temp_array[key($array)] = array_shift($array);

        foreach ($array as $key => $val) {
            $offset = 0;
            $found = false;
            foreach ($temp_array as $tmp_key => $tmp_val) {
                if (!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey])) {
                    $temp_array = array_merge(
                        (array) array_slice($temp_array, 0, $offset),
                        array($key => $val),
                        array_slice($temp_array, $offset)
                    );
                    $found = true;
                }
                $offset++;
            }
            if (!$found) $temp_array = array_merge($temp_array, array($key => $val));
        }

        if ($sort_ascending) $array = array_reverse($temp_array);

        return $temp_array;
    }
}
