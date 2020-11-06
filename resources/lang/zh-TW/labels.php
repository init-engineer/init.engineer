<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => '全部',
        'yes' => '是',
        'no' => '否',
        'copyright' => 'Copyright',
        'custom' => '自定義',
        'actions' => '動作',
        'active' => '活動',
        'buttons' => [
            'save' => '儲存',
            'update' => '更新',
        ],
        'hide' => '隱藏',
        'inactive' => '非活動',
        'none' => '無',
        'show' => '顯示',
        'toggle_navigation' => '切換導航',
        'create_new' => '建立新的',
        'toolbar_btn_groups' => '帶有按鈕組的工具欄',
        'more' => '更多',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => '建立角色',
                'edit' => '編輯角色',
                'management' => '角色管理',

                'table' => [
                    'number_of_users' => '使用者數',
                    'permissions' => '權限',
                    'role' => '角色',
                    'sort' => '排序',
                    'total' => '角色總數|角色總數',
                ],
            ],

            'users' => [
                'active' => '活動使用者',
                'all_permissions' => '所有權限',
                'change_password' => '更改密碼',
                'change_password_for' => '更改密碼 :user',
                'create' => '建立使用者',
                'deactivated' => '已停用的使用者',
                'deleted' => '已刪除的使用者',
                'edit' => '編輯使用者',
                'management' => '使用者管理',
                'no_permissions' => '無權限',
                'no_roles' => '無角色',
                'permissions' => '權限',
                'user_actions' => '使用者功能',

                'table' => [
                    'confirmed' => '認證',
                    'created' => '建立',
                    'email' => '電子信箱',
                    'id' => 'ID',
                    'last_updated' => '最後更新',
                    'name' => '名稱',
                    'first_name' => '名字',
                    'last_name' => '姓氏',
                    'no_deactivated' => '沒有停用的使用者',
                    'no_deleted' => '未刪除使用者',
                    'other_permissions' => '其他權限',
                    'permissions' => '權限',
                    'abilities' => '角色與權限',
                    'roles' => '角色',
                    'social' => '社群帳號',
                    'total' => '使用者總計|使用者總計',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => '概述',
                        'history' => '歷史',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => '頭像',
                            'confirmed' => '已確認',
                            'created_at' => '建立於',
                            'deleted_at' => '已刪除',
                            'email' => '電子信箱',
                            'last_login_at' => '最後登入時間',
                            'last_login_ip' => '最後登入 IP',
                            'last_updated' => '最後更新',
                            'name' => '名稱',
                            'first_name' => '名字',
                            'last_name' => '姓氏',
                            'status' => '狀態',
                            'timezone' => '時區',
                        ],
                    ],
                ],

                'view' => '查看使用者',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => '登入',
            'login_button' => '登入',
            'login_with' => '使用 :social_media 登入',
            'register_box_title' => '註冊',
            'register_button' => '註冊',
            'remember_me' => '記住我',
        ],

        'contact' => [
            'box_title' => '聯絡我們',
            'button' => '發送訊息',
        ],

        'passwords' => [
            'expired_password_box_title' => '您的密碼已過期。',
            'forgot_password' => '忘記密碼？',
            'reset_password_box_title' => '重置密碼',
            'reset_password_button' => '重置密碼',
            'update_password_button' => '更新密碼',
            'send_password_reset_link_button' => '發送密碼重置連結',
        ],

        'user' => [
            'passwords' => [
                'change' => '更改密碼',
            ],

            'profile' => [
                'avatar' => '頭像',
                'created_at' => '建立於',
                'edit_information' => '編輯訊息',
                'email' => '電子信箱',
                'last_updated' => '最後更新',
                'name' => '名稱',
                'first_name' => '名字',
                'last_name' => '姓氏',
                'update_information' => '更新訊息',
            ],
        ],
    ],
];
