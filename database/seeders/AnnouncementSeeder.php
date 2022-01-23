<?php

namespace Database\Seeders;

use App\Domains\Announcement\Models\Announcement;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class AnnouncementSeeder.
 *
 * @extends Seeder
 */
class AnnouncementSeeder extends Seeder
{
    use DisableForeignKeys,
        TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('announcements');

        if (app()->environment(['local', 'testing'])) {
            /*
             * Note: There is currently no UI for this feature. If you are going to build a UI, and if you are going to use a WYSIWYG editor for the message (because it supports HTML on the frontend) that you properly sanitize the input before it is stored in the database.
             */
            Announcement::create([
                'area' => null,
                'type' => 'info',
                'message' => '這是一個<strong>全域</strong>公告，將同時顯示在前臺和後臺，<em>有關更多用法範例，請參見 <strong>AnnouncementSeeder</strong>。</em>',
                'enabled' => true,
            ]);

            Announcement::create([
                'area' => 'frontend',
                'type' => 'warning',
                'message' => '這是一個<strong>前臺</strong>公告，不會在後臺顯示。',
                'enabled' => true,
            ]);

            Announcement::create([
                'area' => 'backend',
                'type' => 'danger',
                'message' => '這是一個<strong>後臺</strong>公告，不會在前臺顯示。',
                'enabled' => true,
            ]);

            Announcement::create([
                'area' => null,
                'type' => 'danger',
                'message' => '這則公告僅會顯示在限定時間內。',
                'enabled' => true,
                'starts_at' => now()->subWeek(),
                'ends_at' => now()->addWeek()
            ]);

            Announcement::create([
                'area' => null,
                'type' => 'danger',
                'message' => '這則公告已被停用。',
                'enabled' => false,
            ]);

            Announcement::create([
                'area' => null,
                'type' => 'danger',
                'message' => '這則公告已過期，因此不會顯示。',
                'enabled' => true,
                'ends_at' => now()->subDay()
            ]);

            Announcement::create([
                'area' => null,
                'type' => 'danger',
                'message' => '這則公告尚未開始，因此不會顯示。',
                'enabled' => true,
                'starts_at' => now()->subWeek(),
                'ends_at' => now()->subDay()
            ]);
        }

        $this->enableForeignKeys();
    }
}
