<?php

namespace App\Console\Commands\Report;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\Backend\Report\IPAddressReport as IPAddressReportMail;

/**
 * Class IPAddressReport.
 */
class IPAddressReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:ip-address';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[自動報告] 浮動 IP Address 倘若變更就自動報告';

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
        if (config('report.ip_address'))
        {
            $http = new Client();
            $response = $http->get('https://api.ipify.org/?format=json');
            $nowIP = json_decode($response->getBody())->ip;
            $cacheIP = Cache::get('ip-address');
            if ($nowIP == $cacheIP)
            {
                echo "IP Address 跟以往一樣。\n\r";
            }
            else
            {
                echo "偵測到 IP Address 更新了！\n\r";
                Cache::forever('ip-address', $nowIP);
                Mail::send(new IPAddressReportMail(['ip_address' => $nowIP]));
            }
        }
    }
}
