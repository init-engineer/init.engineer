<?php

namespace App\Console\Commands\Testing;

use Illuminate\Console\Command;
use App\Repositories\Frontend\Social\AdsRepository;
use App\Services\Socials\Images\ImagesService;

/**
 * Class SocialCardsAds.
 */
class SocialCardsAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:social-cards-ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[測試] 社群平台發文掛上廣告';

    /**
     * @var AdsRepository
     */
    protected $adsRepository;

    /**
     * @var ImagesService
     */
    protected $imagesService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AdsRepository $adsRepository, ImagesService $imagesService)
    {
        parent::__construct();

        $this->adsRepository = $adsRepository;
        $this->imagesService = $imagesService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ads = $this->adsRepository->findRandom();
        $adsImage = imageCreateFromPng(asset($ads->ads_path));

        // $image = $this->imagesService->buildImage([
        //     'content' => '測試廣告效果',
        //     'themeStyle' => 'j874kwoxi2nh64yt67wtphy9m5dmea4q',
        //     'fontStyle' => 'ea98dde8987df3cd8aef75479019b688',
        // ]);

        // dd($image);
    }
}
