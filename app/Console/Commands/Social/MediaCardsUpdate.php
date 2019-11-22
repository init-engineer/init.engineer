<?php

namespace App\Console\Commands\Social;

use App\Models\Social\Cards;
use Illuminate\Console\Command;
use App\Services\Socials\MediaCards\PlurkPrimaryService;
use App\Services\Socials\MediaCards\TwitterPrimaryService;
use App\Services\Socials\MediaCards\FacebookPrimaryService;
use App\Services\Socials\MediaCards\FacebookSecondaryService;

/**
 * Class MediaCardsUpdate.
 */
class MediaCardsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:media-cards-update {value=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '對社群平台爬蟲更新 Likes、分享數。';

    /**
     * @var PlurkPrimaryService
     */
    protected $plurkPrimaryService;

    /**
     * @var TwitterPrimaryService
     */
    protected $twitterPrimaryService;

    /**
     * @var FacebookPrimaryService
     */
    protected $facebookPrimaryService;

    /**
     * @var FacebookSecondaryService
     */
    protected $facebookSecondaryService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        PlurkPrimaryService $plurkPrimaryService,
        TwitterPrimaryService $twitterPrimaryService,
        FacebookPrimaryService $facebookPrimaryService,
        FacebookSecondaryService $facebookSecondaryService)
    {
        parent::__construct();

        $this->plurkPrimaryService = $plurkPrimaryService;
        $this->twitterPrimaryService = $twitterPrimaryService;
        $this->facebookPrimaryService = $facebookPrimaryService;
        $this->facebookSecondaryService = $facebookSecondaryService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        switch ($this->argument('value'))
        {
            case 'all':
                ini_set("memory_limit", "2048M");
                ini_set("max_execution_time", "86400");
                $socialCards = Cards::orderBy('id', 'desc')->get();
                break;

            default:
                $socialCards = Cards::orderBy('id', 'desc')->take($this->argument('value'))->get();
                break;
        }

        foreach ($socialCards as $card)
        {
            $this->plurkPrimaryService->update($card);
            $this->twitterPrimaryService->update($card);
            $this->facebookPrimaryService->update($card);
            $this->facebookSecondaryService->update($card);
        }
    }
}
