<?php

namespace Database\Seeders\Social;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Comments;
use App\Domains\Social\Models\Platform;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class SocialCommentsTableSeeder.
 *
 * @extends Seeder
 */
class SocialCommentsTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        if (app()->environment(['local', 'testing'])) {
            foreach (Cards::all() as $card) {
                foreach (Platform::all() as $platform) {
                    for ($i = 0; $i < 10; $i++) {
                        $user_id = ($platform->id === 1) ? 2 : Str::random();
                        Comments::create([
                            'card_id' => $card->id,
                            'platform_id' => $platform->id,
                            'comment_id' => $platform->id . '_' . $card->id . '_' . $user_id,
                            'user_name' => $user_id,
                            'user_id' => $user_id,
                            'user_avatar' => 'https://www.gravatar.com/avatar',
                            'content' => Str::random(1024),
                            'active' => true,
                        ]);
                    }
                }
            }
        }

        $this->enableForeignKeys();
    }
}
