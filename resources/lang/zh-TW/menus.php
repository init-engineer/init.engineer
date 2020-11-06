<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => '帳號管理系統',

            'roles' => [
                'all' => '全部角色',
                'create' => '建立角色',
                'edit' => '編輯角色',
                'management' => '角色管理',
                'main' => '角色',
            ],

            'users' => [
                'all' => '全部使用者',
                'change-password' => '更改密碼',
                'create' => '建立使用者',
                'deactivated' => '已被停用的使用者',
                'deleted' => '已被刪除的使用者',
                'edit' => '編輯使用者',
                'main' => '使用者',
                'view' => '查看使用者',
            ],
        ],

        'course' => [
            'edit' => '課程編輯',
            'view' => '學員列表'
        ],

        'log-viewer' => [
            'main' => '日誌檢視器',
            'dashboard' => '儀表板',
            'logs' => '詳細日誌',
        ],

        'sidebar' => [
            'dashboard' => '儀表板',
            'general' => '一般',
            'history' => '歷史',
            'system' => '系統',
        ],
    ],

    'language-picker' => [
        'language' => '語言',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => '阿拉伯語(Arabic)',
            'az' => '阿塞拜疆語(Azerbaijan)',
            'zh' => '簡體中文(Chinese Simplified)',
            'zh-TW' => '繁體中文(Chinese Traditional)',
            'da' => '丹麥語(Danish)',
            'de' => '德語(German)',
            'el' => '希臘語(Greek)',
            'en' => '英語(English)',
            'es' => '西班牙語(Spanish)',
            'fa' => '波斯語 (Persian)',
            'fr' => '法語(French)',
            'he' => '希伯來語 (Hebrew)',
            'id' => '印度尼西亞語(Indonesian)',
            'it' => '意大利語(Italian)',
            'ja' => '日語(Japanese)',
            'nl' => '荷蘭語(Dutch)',
            'no' => '挪威 (Norwegian)',
            'pt_BR' => '巴西葡萄牙語(Brazilian Portuguese)',
            'ru' => '俄語(Russian)',
            'sv' => '瑞典語(Swedish)',
            'th' => '泰語(Thai)',
            'tr' => '土耳其語(Turkish)',
            'uk' => '烏克蘭語(Ukrainian)',
        ],
    ],
];
