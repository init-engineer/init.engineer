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
        'create_new' => '新增',
        'toolbar_btn_groups' => '帶有按鈕組的工具欄',
        'more' => '更多',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => '新增角色',
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
                'create' => '新增使用者',
                'deactivated' => '已停用的使用者',
                'deleted' => '已刪除的使用者',
                'edit' => '編輯使用者',
                'management' => '使用者管理',
                'no_permissions' => '無權限',
                'no_roles' => '無角色',
                'permissions' => '權限',
                'user_actions' => '使用者動作',

                'table' => [
                    'id' => 'ID/編號',
                    'picture' => '大頭貼',
                    'confirmed' => '認證',
                    'created' => '新增',
                    'email' => '電子信箱(E-mail)',
                    'last_updated' => '最後更新',
                    'name' => '名稱',
                    'first_name' => '名稱',
                    'last_name' => '姓氏',
                    'no_deactivated' => '沒有已停用的使用者',
                    'no_deleted' => '沒有已刪除的使用者',
                    'other_permissions' => '其他權限',
                    'permissions' => '權限',
                    'abilities' => '角色及權限',
                    'roles' => '角色',
                    'social' => '社群媒體',
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
                            'created_at' => '新增於',
                            'deleted_at' => '已刪除',
                            'email' => '電子信箱(E-mail)',
                            'last_login_at' => '最後登入於',
                            'last_login_ip' => '最後登入 IP',
                            'last_updated' => '最後更新',
                            'name' => '名稱',
                            'first_name' => '名稱',
                            'last_name' => '姓氏',
                            'status' => '狀態',
                            'timezone' => '時區',
                        ],
                    ],
                ],

                'view' => '查看使用者',
            ],
        ],

        'social' => [
            'cards' => [
                'management' => '文章',
                'active' => '通過審核文章',
                'deactivated' => '已軟刪除文章',
                'deleted' => 'Deleted',
                'card_actions' => '文章動作',
                'view' => '查看文章',
                'detail' => '文章詳細資訊',
                'link' => '社群連結',
                'comment' => '留言列表',
                'review' => '審核名單',

                'table' => [
                    'socials' => '社群列表',
                    'like' => '按讚數量',
                    'share' => '分享數量',
                    'content' => '內容',
                    'roles' => '角色列表',
                    'confirmed' => '認證',
                    'created' => '新增',
                    'id' => 'ID/編號',
                    'user' => 'User(E-mail)',
                    'content' => '文章內容',
                    'active' => '審核狀態',
                    'banned' => '黑名單',
                    'review' => '群眾審核',
                    'last_updated' => '最後更新',
                    'name' => '名稱',
                    'first_name' => '名稱',
                    'last_name' => '姓氏',
                    'no_deactivated' => '沒有已停用的文章',
                    'no_deleted' => '沒有已刪除的文章',
                    'total' => '文章總計|文章總計',
                ],
            ],

            'comments' => [
                'management' => 'Comments',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'LOGIN',
            'login_button' => '登入',
            'login_with' => '使用 :social_media 登入',
            'register_box_title' => 'REGISTER',
            'register_button' => '註冊',
            'remember_me' => '記住我',
            'authorization_box_title' => 'AUTHORIZATION',
        ],

        'contact' => [
            'box_title' => 'CONTACT',
            'box_text' => '聯絡我們',
            'button' => '送出訊息',
        ],

        'passwords' => [
            'expired_password_box_title' => 'EXPIRED PASSWORD',
            'expired_password_text' => '您的密碼已過期。',
            'forgot_password_title' => 'FORGOT PASSWORD',
            'forgot_password_text' => '忘記密碼？ ',
            'forgot_password' => '忘記密碼？ ',
            'reset_password_box_title' => 'RESET PASSWORD',
            'reset_password_box_text' => '重置密碼',
            'reset_password_button' => '重置密碼',
            'update_password_button' => '更新密碼',
            'send_password_reset_link_button' => '發送密碼重置連結',
        ],

        'policies' => [
            'policies_title' => 'POLICIES',
            'policies_text' => '網站服務條款 & 隱私權政策',
        ],

        'user' => [
            'dashboard' => [
                'dashboard_text' => 'DASHBOARD',
            ],

            'passwords' => [
                'change' => '更改密碼',
            ],

            'profile' => [
                'avatar' => '頭像',
                'created_at' => '新增於',
                'edit_information' => '編輯訊息',
                'email' => '電子信箱(E-mail)',
                'last_updated' => '最後更新',
                'name' => '名稱',
                'first_name' => '名稱',
                'last_name' => '姓氏',
                'update_information' => '更新訊息',
            ],
        ],
    ],
];
