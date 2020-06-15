<?php

namespace App\Console\Commands\Social;

use App\Models\Social\Cards;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\Socials\Cards\CardsService;
use App\Repositories\Backend\Social\CardsRepository as BackendCardsRepository;
use App\Repositories\Frontend\Social\CardsRepository as FrontendCardsRepository;

/**
 * Class ReviewPublish.
 */
class ReviewPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:review-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '檢查群眾審核，並且發表文章。';

    /**
     * @var CardsService
     */
    protected $cardsService;

    /**
     * @var BackendCardsRepository
     */
    protected $backendCardsRepository;

    /**
     * @var FrontendCardsRepository
     */
    protected $frontendCardsRepository;

    /**
     * Create a new command instance.
     *
     * @param CardsService $cardsService
     * @param BackendCardsRepository $backendCardsRepository
     * @param FrontendCardsRepository $frontendCardsRepository
     *
     * @return void
     */
    public function __construct(
        CardsService $cardsService,
        BackendCardsRepository $backendCardsRepository,
        FrontendCardsRepository $frontendCardsRepository)
    {
        parent::__construct();

        $this->cardsService = $cardsService;
        $this->backendCardsRepository = $backendCardsRepository;
        $this->frontendCardsRepository = $frontendCardsRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $paginator = $this->frontendCardsRepository->getUnactivePaginated(10, 'created_at', 'asc');
        foreach ($paginator as $card)
        {
            $range = 50;
            if ($card->created_at >= Carbon::now()->addHours(-6)) $range = 30;
            if ($card->created_at >= Carbon::now()->addHours(-3)) $range = 20;
            if ($card->created_at >= Carbon::now()->addHours(-1)) $range = 10;

            $point = 0;
            foreach ($card->reviews as $review)
            {
                $point += $review->point;
            }

            if ($point >= $range)
            {
                $cards = Cards::find($card->id);
                $this->backendCardsRepository->active($cards);
                $this->cardsService->publish($cards);

                return;
            }
        }
    }
}
