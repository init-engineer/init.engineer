<?php

namespace Database\Seeders;

use Database\Seeders\Social\SocialAdsTableSeeder;
use Database\Seeders\Social\SocialCardsTableSeeder;
use Database\Seeders\Social\SocialCommentsTableSeeder;
use Database\Seeders\Social\SocialPlatformTableSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class SocialTableSeeder.
 *
 * @extends Seeder
 */
class SocialTableSeeder extends Seeder
{
    use DisableForeignKeys,
        TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'social_platform',
            'social_cards_ads',
            'social_cards',
            'social_comments',
        ]);

        $this->call(SocialPlatformTableSeeder::class);
        $this->call(SocialAdsTableSeeder::class);
        $this->call(SocialCardsTableSeeder::class);
        $this->call(SocialCommentsTableSeeder::class);

        $this->enableForeignKeys();
    }
}
