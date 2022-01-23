<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 *
 * @extends Seeder
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        Role::create([
            'id' => 1,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
        ]);

        // Create Social Management Roles
        $socialRole = Role::create([
            'id' => 2,
            'type' => User::TYPE_ADMIN,
            'name' => 'Social Management',
        ]);

        // Create Social Platform Management Roles
        $socialPlatformRole = Role::create([
            'id' => 3,
            'type' => User::TYPE_ADMIN,
            'name' => 'Social Platform Management',
        ]);

        // Create Social Ads Management Roles
        $socialAdsRole = Role::create([
            'id' => 4,
            'type' => User::TYPE_ADMIN,
            'name' => 'Social Ads Management',
        ]);

        // Create Social Cards Management Roles
        $socialCardsRole = Role::create([
            'id' => 5,
            'type' => User::TYPE_ADMIN,
            'name' => 'Social Cards Management',
        ]);

        // Create Social Comments Management Roles
        $socialCommentsRole = Role::create([
            'id' => 6,
            'type' => User::TYPE_ADMIN,
            'name' => 'Social Comments Management',
        ]);

        // Create Social Reviews Management Roles
        $socialReviewsRole = Role::create([
            'id' => 7,
            'type' => User::TYPE_ADMIN,
            'name' => 'Social Reviews Management',
        ]);

        // Create Announcements Management Roles
        $announcementsRole = Role::create([
            'id' => 8,
            'type' => User::TYPE_ADMIN,
            'name' => 'Announcement Management',
        ]);

        /**
         * Non Grouped Permissions
         */

        /**
         * Grouped permissions
         * Users category
         */
        $users = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user',
            'description' => 'All User Permissions',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.list',
                'description' => 'View Users',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.deactivate',
                'description' => 'Deactivate Users',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.reactivate',
                'description' => 'Reactivate Users',
                'sort' => 3,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.clear-session',
                'description' => 'Clear User Sessions',
                'sort' => 4,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.impersonate',
                'description' => 'Impersonate Users',
                'sort' => 5,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.change-password',
                'description' => 'Change User Passwords',
                'sort' => 6,
            ]),
        ]);

        $socialPremission = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.social',
            'description' => 'All Social Permissions',
        ]);

        $socialPlatformPremission = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.social.platform',
            'description' => 'All Social Platform Permissions',
        ]);

        $socialAdsPremission = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.social.ads',
            'description' => 'All Social Ads Permissions',
            'sort' => 2,
        ]);

        $socialCardsPremission = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.social.cards',
            'description' => 'All Social Cards Permissions',
            'sort' => 3,
        ]);

        $socialCommentsPremission = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.social.comments',
            'description' => 'All Social Comments Permissions',
            'sort' => 4,
        ]);

        $socialReviewsPremission = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.social.reviews',
            'description' => 'All Social Reviews Permissions',
            'sort' => 5,
        ]);

        $socialPremission->children()->saveMany([
            $socialPlatformPremission,
            $socialAdsPremission,
            $socialCardsPremission,
            $socialCommentsPremission,
            $socialReviewsPremission,
        ]);

        $socialPlatformPremission->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.platform.list',
                'description' => 'View Platforms',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.platform.deactivate',
                'description' => 'Deactivate Platforms',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.platform.reactivate',
                'description' => 'Reactivate Platforms',
                'sort' => 3,
            ]),
        ]);

        $socialAdsPremission->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.ads.list',
                'description' => 'View Ads',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.ads.deactivate',
                'description' => 'Deactivate Ads',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.ads.reactivate',
                'description' => 'Reactivate Ads',
                'sort' => 3,
            ]),
        ]);

        $socialCardsPremission->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.cards.list',
                'description' => 'View Cards',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.cards.deactivate',
                'description' => 'Deactivate Cards',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.cards.reactivate',
                'description' => 'Reactivate Cards',
                'sort' => 3,
            ]),
        ]);

        $socialCommentsPremission->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.comments.list',
                'description' => 'View Comments',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.comments.deactivate',
                'description' => 'Deactivate Comments',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.comments.reactivate',
                'description' => 'Reactivate Comments',
                'sort' => 3,
            ]),
        ]);

        $socialReviewsPremission->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.reviews.list',
                'description' => 'View Reviews',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.reviews.deactivate',
                'description' => 'Deactivate Reviews',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.social.reviews.reactivate',
                'description' => 'Reactivate Reviews',
                'sort' => 3,
            ]),
        ]);

        $socialRole->syncPermissions([$socialPremission]);
        $socialPlatformRole->syncPermissions([$socialPlatformPremission]);
        $socialAdsRole->syncPermissions([$socialAdsPremission]);
        $socialCardsRole->syncPermissions([$socialCardsPremission]);
        $socialCommentsRole->syncPermissions([$socialCommentsPremission]);
        $socialReviewsRole->syncPermissions([$socialReviewsPremission]);

        $announcement = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.announcement',
            'description' => 'All Announcements Permissions',
        ]);

        $announcement->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.announcement.list',
                'description' => 'View Announcements',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.announcement.deactivate',
                'description' => 'Deactivate Announcements',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.announcement.reactivate',
                'description' => 'Reactivate Announcements',
                'sort' => 3,
            ]),
        ]);

        /**
         * Assign Permissions to other Roles
         */

        $this->enableForeignKeys();
    }
}
