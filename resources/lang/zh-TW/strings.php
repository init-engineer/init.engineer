<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => '您確定要永久刪除此使用者嗎？引用此使用者 ID 的應用程式中的任何地方都很可能是錯誤，繼續自行承擔風險，這不能被撤消。',
                'if_confirmed_off' => '(需要將驗證關閉)',
                'no_deactivated' => '沒有停用的使用者.',
                'no_deleted' => '沒有刪除的使用者。',
                'restore_user_confirm' => '將此使用者恢復到其原始狀態？ ',
            ],
        ],

        'social' => [
            'cards' => [
                'no_deleted' => 'There are no deleted cards.',
            ],
        ],

        'dashboard' => [
            'title' => '管理儀表板',
            'welcome' => '哈囉',
        ],

        'general' => [
            'all_rights_reserved' => 'All rights reserved.',
            'are_you_sure' => '您確定嗎？ ',
            'continue' => '繼續',
            'member_since' => '會員自',
            'minutes' => ' 分鐘',
            'search_placeholder' => '搜尋 ...',
            'timeout' => '基於安全因素，您因為長期沒有活動而被系統自動登出。',

            'see_all' => [
                'messages' => '查看所有郵件',
                'notifications' => '查看全部',
                'tasks' => '查看所有任務',
            ],

            'status' => [
                'online' => '在線',
                'offline' => '離線',
            ],

            'you_have' => [
                'messages' => '{0} 您沒有消息|{1} 您有1個消息|[2,Inf] 您有 :number 個消息',
                'notifications' => '{0} 您沒有通知|{1} 您有1個通知|[2,Inf] 您有 :number 個通知',
                'tasks' => '{0} 您沒有任務|{1} 您有1個任務|[2,Inf] 您有 :number 個任務',
            ],
        ],

        'search' => [
            'empty' => '請輸入搜尋字詞。',
            'incomplete' => '您必須為此系統撰寫您自己的搜尋邏輯。',
            'title' => '搜尋結果',
            'results' => '搜尋結果 :query',
        ],

        'welcome' => '歡迎來到儀表板',
    ],

    'emails' => [
        'auth' => [
            'account_confirmed' => '您的帳號已被認證。',
            'error' => '噢！',
            'greeting' => '您好！',
            'regards' => '問候，',
            'trouble_clicking_button' => '如果您在點擊 ":action_text" 按鈕時遇到問題, 請將以下網址複製並貼上到您的網路瀏覽器中:',
            'thank_you_for_using_app' => '謝謝您使用我們的應用程式！ ',

            'password_reset_subject' => '重置密碼',
            'password_cause_of_email' => '您收到此電子信箱是因為我們收到了您帳號的密碼重設要求',
            'password_if_not_requested' => '如果您沒有請求重置密碼，則無需進一步操作',
            'reset_password' => '點擊這裡重置密碼',

            'click_to_confirm' => '點擊此處確認您的帳號:',
        ],

        'contact' => [
            'email_body_title' => '您有新的聯絡表單請求，以下是詳細訊息:',
            'subject' => '有新的 :app_name 聯絡表單提交！',
        ],
    ],

    'frontend' => [
        'test' => '測試',

        'tests' => [
            'based_on' => [
                'permission' => '基於權限 - ',
                'role' => '基於角色 - ',
            ],

            'js_injected_from_controller' => 'JavaScript 從控制器注入',

            'using_blade_extensions' => '使用 Blade 切版',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => '查看控制台，您應該看到 \'運作\' 來自 FrontendController@index',
            'you_can_see_because' => '您可以看到這個，是因為您有角色 \':role\'!',
            'you_can_see_because_permission' => '您可以看到這個，是因為您有權限 \':permission\'!',
        ],

        'general' => [
            'joined' => '加入',
        ],

        'user' => [
            'change_email_notice' => '如果您更改了電子信箱，則在您確認新的電子信箱地址之前，您的帳號將處於停用狀態。',
            'email_changed_notice' => '您必須先確認新的電子信箱地址，然後才能再次登入。',
            'profile_updated' => '資料已成功更新。',
            'password_updated' => '密碼已成功更新。',
        ],

        'welcome_to' => '歡迎來到 :place',
    ],
];
