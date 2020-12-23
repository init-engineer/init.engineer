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
            'title' => 'Access',

            'roles' => [
                'all' => '所有角色',
                'create' => '新增角色',
                'edit' => '編輯角色',
                'management' => '角色管理',
                'main' => '角色列表',
            ],

            'users' => [
                'all' => '所有使用者',
                'change-password' => '修改密碼',
                'create' => '新增使用者',
                'deactivated' => '被停用的使用者',
                'deleted' => '被刪除的使用者',
                'edit' => '編輯使用者',
                'main' => '使用者列表',
                'view' => '使用者',
            ],
        ],

        'social' => [
            'title' => 'Social',

            'cards' => [
                'main' => '文章列表',
                'all' => '所有文章',
                'deactivated' => '被停用的文章',
                'deleted' => '被刪除的文章',
                'view' => '查看',
            ],
        ],

        'log-viewer' => [
            'main' => '日誌列表',
            'dashboard' => '儀表板',
            'logs' => '日誌',
        ],

        'sidebar' => [
            'dashboard' => '儀表板',
            'general' => '一般',
            'history' => '歷史',
            'account' => '使用者',
            'social' => '文章',
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
            'fa' => '波斯語 (Persian) ',
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
