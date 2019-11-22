<?php

namespace App\Console\Commands\Social;

use Illuminate\Console\Command;

/**
 * Class MediaCardsPublish.
 */
class MediaCardsPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:media-cards-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '將文章發表至社群平台當中。';

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
        //
    }
}
