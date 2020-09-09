<?php

namespace App\Console\Commands\Testing;

use App\Models\Social\Cards;
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
        $card = Cards::find(1);
        $ads = $this->adsRepository->findRandom($card);

        $image = $this->imagesService->buildImage([
            'content' => '測試廣告效果',
            'themeStyle' => '2e6046c7387d8fbe9acd700394a3add3',
            // 'themeStyle' => '32d2a897602ef652ed8e15d66128aa74',
            // 'themeStyle' => 'a5c95b86291ea299fcbe64458ed12702',
            'fontStyle' => 'ea98dde8987df3cd8aef75479019b688',
        ], $card);

        // dd($image);
    }
}
