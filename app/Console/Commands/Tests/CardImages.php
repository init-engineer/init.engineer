<?php

namespace App\Console\Commands\Tests;

use App\Services\Socials\Images\ImagesService;
use Illuminate\Console\Command;

/**
 * Class CardImages.
 */
class CardImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:card-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[測試] 圖片產生器';

    /**
     * @var ImagesService
     */
    protected $imagesService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImagesService $imagesService)
    {
        parent::__construct();

        $this->imagesService = $imagesService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->imagesService->buildImage([
            'content' => '一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器，一二三四五六七八九十一二三四五六七八九十，測試圖片產生器。',
            'thmemStyle' => '32d2a897602ef652ed8e15d66128aa74',
            'fontStyle' => 'ea98dde8987df3cd8aef75479019b688',
            'avatarPath' => 'app/public/cards/',
            'isManagerLine' => true,
        ]);
    }
}
