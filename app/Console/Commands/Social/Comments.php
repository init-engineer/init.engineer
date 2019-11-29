<?php

namespace App\Console\Commands\Social;

use App\Models\Social\Cards;
use Illuminate\Console\Command;
use App\Jobs\Social\Comments\PlurkPrimaryComments;
use App\Jobs\Social\Comments\TwitterPrimaryComments;
use App\Jobs\Social\Comments\FacebookPrimaryComments;
use App\Jobs\Social\Comments\FacebookSecondaryComments;

/**
 * Class Comments.
 */
class Comments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:comments-update {value=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '對社群平台爬蟲更新留言。';

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
        switch ($this->argument('value'))
        {
            case 'all':
                ini_set("memory_limit", "2048M");
                ini_set("max_execution_time", "86400");
                $socialCards = Cards::orderBy('id', 'desc')->publish()->get();
                break;

            default:
                $socialCards = Cards::orderBy('id', 'desc')->publish()->take($this->argument('value'))->get();
                break;
        }

        foreach ($socialCards as $cards)
        {
            if (env('FACEBOOK_PRIMARY_CREATE_POST', false)) { FacebookPrimaryComments::dispatch($cards); }
            if (env('FACEBOOK_SECONDARY_CREATE_POST', false)) { FacebookSecondaryComments::dispatch($cards); }
            if (env('TWITTER_CREATE_POST', false)) { TwitterPrimaryComments::dispatch($cards); }
            if (env('PLURK_CREATE_POST', false)) { PlurkPrimaryComments::dispatch($cards); }
        }
    }
}
