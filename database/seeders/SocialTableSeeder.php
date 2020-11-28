<?php

namespace Database\Seeders;

use Database\Seeders\Social\SocialPlatformTableSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class SocialTableSeeder.
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
        ]);

        $this->call(SocialPlatformTableSeeder::class);

        $this->enableForeignKeys();
    }
}
