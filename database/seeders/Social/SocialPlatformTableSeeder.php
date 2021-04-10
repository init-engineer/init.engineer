<?php

namespace Database\Seeders\Social;

use App\Domains\Social\Models\Platform;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class SocialPlatformTableSeeder.
 */
class SocialPlatformTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        Platform::create([
            'name' => '本地平台',
            'action' => Platform::ACTION_INACTION,
            'type' => Platform::TYPE_LOCAL,
            'active' => true,
        ]);

        Platform::create([
            'name' => '官方正式 @init.kobeengineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_FACEBOOK,
            'active' => false,
            'config' => json_encode([
                'user_id' => null,
                'consumer_app_id' => null,
                'consumer_app_secret' => null,
                'access_token' => null,
                'graph_version' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方測試 @kaobei.engineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_FACEBOOK,
            'active' => false,
            'config' => json_encode([
                'user_id' => null,
                'consumer_app_id' => null,
                'consumer_app_secret' => null,
                'access_token' => null,
                'graph_version' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方正式 @kaobei_engineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_TWITTER,
            'active' => false,
            'config' => json_encode([
                'consumer_app_key' => null,
                'consumer_app_secret' => null,
                'access_token' => null,
                'access_token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方測試 @kobeengineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_TWITTER,
            'active' => false,
            'config' => json_encode([
                'consumer_app_key' => null,
                'consumer_app_secret' => null,
                'access_token' => null,
                'access_token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方 @kaobei_engineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_PLURK,
            'active' => false,
            'config' => json_encode([
                'consumer_app_id' => null,
                'consumer_app_secret' => null,
                'access_token' => null,
                'access_token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方 @kaobei-engineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_TUMBLR,
            'active' => false,
            'config' => json_encode([
                'user_id' => null,
                'consumer_app_key' => null,
                'consumer_app_secret' => null,
                'access_token' => null,
                'access_token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方 @init.engineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_TELEGRAM,
            'active' => false,
            'config' => json_encode([
                'chat_id' => null,
                'access_token' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方發表文章通知 @init.engineer',
            'action' => Platform::ACTION_NOTIFICATION,
            'type' => Platform::TYPE_DISCORD,
            'active' => false,
            'config' => json_encode([
                'webhook' => null,
            ]),
        ]);

        Platform::create([
            'name' => '官方審核通過通知 @init.engineer',
            'action' => Platform::ACTION_PUBLISH,
            'type' => Platform::TYPE_DISCORD,
            'active' => false,
            'config' => json_encode([
                'webhook' => null,
            ]),
        ]);

        $this->enableForeignKeys();
    }
}
