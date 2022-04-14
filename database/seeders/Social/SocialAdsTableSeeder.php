<?php

namespace Database\Seeders\Social;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Ads;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class SocialAdsTableSeeder.
 *
 * @extends Seeder
 */
class SocialAdsTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        if (app()->environment(['local', 'testing'])) {
            Ads::create([
                'model_type' => User::class,
                'model_id' => 1,
                'name' => '橫幅廣告測試，已付款、已啟用',
                'picture' => [
                    'local' => 'img/default/banner-ads.png',
                    'storage' => null,
                    'imgur' => null,
                ],
                'probability' => 1000,
                'payment' => true,
                'active' => true,
                'starts_at' => now()->subWeek(),
                'ends_at' => now()->addWeek()
            ]);

            Ads::create([
                'model_type' => User::class,
                'model_id' => 1,
                'name' => '橫幅廣告測試，未付款、已啟用',
                'picture' => [
                    'local' => 'img/default/banner-ads.png',
                    'storage' => null,
                    'imgur' => null,
                ],
                'probability' => 1000,
                'payment' => false,
                'active' => true,
                'starts_at' => now()->subWeek(),
                'ends_at' => now()->addWeek()
            ]);

            Ads::create([
                'model_type' => User::class,
                'model_id' => 1,
                'name' => '橫幅廣告測試，未付款、未啟用',
                'picture' => [
                    'local' => 'img/default/banner-ads.png',
                    'storage' => null,
                    'imgur' => null,
                ],
                'probability' => 1000,
                'payment' => false,
                'active' => false,
                'starts_at' => now()->subWeek(),
                'ends_at' => now()->addWeek()
            ]);
        }

        $this->enableForeignKeys();
    }
}
