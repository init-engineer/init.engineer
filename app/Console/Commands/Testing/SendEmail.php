<?php

namespace App\Console\Commands\Testing;

use Mail;
use Cache;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Mail\Backend\Report\IPAddressReport as IPAddressReportMail;

/**
 * Class SendEmail.
 */
class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $http = new Client();
        $response = $http->get('https://api.ipify.org/?format=json');
        $nowIP = json_decode($response->getBody())->ip;
        $cacheIP = Cache::get('ip-address');

        Cache::forever('ip-address', $nowIP);
        Mail::send(new IPAddressReportMail(['ip_address' => $nowIP]));
    }
}
