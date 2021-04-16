<?php

namespace Database\Seeders\Social;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Cards;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class SocialCardsTableSeeder.
 */
class SocialCardsTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        if (app()->environment(['local', 'testing'])) {
            Cards::create([
                'model_type' => User::class,
                'model_id' => 1,
                'content' => '這是一篇測試文章，已通過群眾審核，並且沒有橫幅廣告資訊。',
                'config' => json_encode(array(
                    'probability' => 2000,
                    'item' => array(
                        array(
                            'id' => 1,
                            'probability' => 1000,
                        ),
                    ),
                )),
                'picture' => json_encode(array(
                    'local' => 'img/default/800x600.png',
                    'storage' => null,
                    'imgur' => null,
                )),
                'active' => true,
                'blockade' => false,
                'blockade_by' => null,
                'blockade_remarks' => null,
                'blockade_at' => null,
            ]);

            Cards::create([
                'model_type' => User::class,
                'model_id' => 1,
                'content' => '這是一篇測試文章，已通過群眾審核，並且包含橫幅廣告資訊。',
                'config' => json_encode(array(
                    'probability' => 500,
                    'item' => array(
                        array(
                            'id' => 1,
                            'probability' => 1000,
                        ),
                    ),
                )),
                'picture' => json_encode(array(
                    'local' => 'img/default/800x600.png',
                    'storage' => null,
                    'imgur' => null,
                )),
                'active' => true,
                'blockade' => false,
                'blockade_by' => null,
                'blockade_remarks' => null,
                'blockade_at' => null,
            ]);

            Cards::create([
                'model_type' => User::class,
                'model_id' => 1,
                'content' => '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第一行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第二行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第三行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第四行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第五行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第六行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第七行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第八行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第九行。\n\r' .
                             '這是一篇測試文章，已通過群眾審核，不僅包含橫幅廣告資訊，文章內容還相當得長，這是其中的第十行。',
                'config' => json_encode(array(
                    'probability' => 500,
                    'item' => array(
                        array(
                            'id' => 1,
                            'probability' => 1000,
                        ),
                    ),
                )),
                'picture' => json_encode(array(
                    'local' => 'img/default/800x600.png',
                    'storage' => null,
                    'imgur' => null,
                )),
                'active' => true,
                'blockade' => false,
                'blockade_by' => null,
                'blockade_remarks' => null,
                'blockade_at' => null,
            ]);

            Cards::create([
                'model_type' => User::class,
                'model_id' => 1,
                'content' => '這是一篇測試文章，尚未通過群眾審核，並且沒有橫幅廣告資訊。',
                'config' => json_encode(array(
                    'probability' => 2000,
                    'item' => array(
                        array(
                            'id' => 1,
                            'probability' => 1000,
                        ),
                    ),
                )),
                'picture' => json_encode(array(
                    'local' => 'img/default/800x600.png',
                    'storage' => null,
                    'imgur' => null,
                )),
                'active' => false,
                'blockade' => false,
                'blockade_by' => null,
                'blockade_remarks' => null,
                'blockade_at' => null,
            ]);

            Cards::create([
                'model_type' => User::class,
                'model_id' => 1,
                'content' => '這是一篇測試文章，尚未通過群眾審核，但是包含橫幅廣告資訊。',
                'config' => json_encode(array(
                    'probability' => 500,
                    'item' => array(
                        array(
                            'id' => 1,
                            'probability' => 1000,
                        ),
                    ),
                )),
                'picture' => json_encode(array(
                    'local' => 'img/default/800x600.png',
                    'storage' => null,
                    'imgur' => null,
                )),
                'active' => false,
                'blockade' => false,
                'blockade_by' => null,
                'blockade_remarks' => null,
                'blockade_at' => null,
            ]);

            Cards::create([
                'model_type' => User::class,
                'model_id' => 1,
                'content' => '這是一篇測試文章，已被發表出去，並且文章遭到封鎖。',
                'config' => json_encode(array(
                    'probability' => 2000,
                    'item' => array(
                        array(
                            'id' => 1,
                            'probability' => 1000,
                        ),
                    ),
                )),
                'picture' => json_encode(array(
                    'local' => 'img/default/800x600.png',
                    'storage' => null,
                    'imgur' => null,
                )),
                'active' => true,
                'blockade' => true,
                'blockade_by' => 1,
                'blockade_remarks' => '這是一則測試的封鎖文章訊息。',
                'blockade_at' => now(),
            ]);
        }

        $this->enableForeignKeys();
    }
}
