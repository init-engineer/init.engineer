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
            'name' => 'primary',
            'type' => 'local',
            'active' => true,
            'config' => json_encode([]),
        ]);

        Platform::create([
            'name' => 'primary',
            'type' => 'facebook',
            'active' => false,
            'config' => json_encode([
                'user_id' => null,
                'app_id' => null,
                'app_secret' => null,
                'graph_version' => null,
                'access_token' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => 'secondary',
            'type' => 'facebook',
            'active' => false,
            'config' => json_encode([
                'user_id' => null,
                'app_id' => null,
                'app_secret' => null,
                'graph_version' => null,
                'access_token' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => 'primary',
            'type' => 'twitter',
            'active' => false,
            'config' => json_encode([
                'consumer_key' => null,
                'consumer_secret' => null,
                'access_token' => null,
                'access_token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => 'secondary',
            'type' => 'twitter',
            'active' => false,
            'config' => json_encode([
                'consumer_key' => null,
                'consumer_secret' => null,
                'access_token' => null,
                'access_token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => 'primary',
            'type' => 'plurk',
            'active' => false,
            'config' => json_encode([
                'client_id' => null,
                'client_secret' => null,
                'token' => null,
                'token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        Platform::create([
            'name' => 'secondary',
            'type' => 'plurk',
            'active' => false,
            'config' => json_encode([
                'client_id' => null,
                'client_secret' => null,
                'token' => null,
                'token_secret' => null,
                'pages_name' => null,
            ]),
        ]);

        $this->enableForeignKeys();
    }
}
