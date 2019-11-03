<?php

namespace App\Console\Commands\Tests;

use App\Models\Social\Cards;
use Illuminate\Console\Command;
use App\Services\Socials\MediaCards\PlurkPrimaryService;
use App\Services\Socials\MediaCards\TwitterPrimaryService;
use App\Services\Socials\MediaCards\FacebookPrimaryService;
use App\Services\Socials\MediaCards\FacebookSecondaryService;

class SocialCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:social-cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[測試] 社群平台發文';

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
        // $cards = Cards::find(2720);
        // dd($this->plurkPrimaryService->publish($cards));         // OK, Success.
        // dd($this->twitterPrimaryService->publish($cards));       // OK, Success.
        // dd($this->facebookPrimaryService->publish($cards));      // OK, Success.
        // dd($this->facebookSecondaryService->publish($cards));    // OK, Success.
    }
}
