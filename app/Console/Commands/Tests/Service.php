<?php

namespace App\Console\Commands\Tests;

use App\Models\Social\Cards;
use Illuminate\Console\Command;
use App\Services\Socials\Comments\PlurkPrimaryService;
use App\Services\Socials\Comments\FacebookPrimaryService;
use App\Services\Socials\Comments\FacebookSecondaryService;

/**
 * Class Service.
 */
class Service extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var PlurkPrimaryService
     */
    protected $plurkPrimaryService;

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
        // TwitterPrimaryService $facebookPrimaryService,
        FacebookPrimaryService $facebookPrimaryService,
        FacebookSecondaryService $facebookSecondaryService)
    {
        parent::__construct();

        $this->plurkPrimaryService = $plurkPrimaryService;
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
        $this->plurkPrimaryService->getComments(Cards::find(1354));
        // $this->facebookPrimaryService->getComments(Cards::find(1354));
        // $this->facebookSecondaryService->getComments(Cards::find(1354));
    }
}
