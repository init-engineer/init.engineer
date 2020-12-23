<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => '角色已成功新增。',
            'deleted' => '角色已成功刪除。',
            'updated' => '角色已成功更新。',
        ],

        'users' => [
            'cant_resend_confirmation' => '該應用程式當前設定為手動核准使用者。',
            'confirmation_email' => '新的確認電子信箱(E-mail)已發送到文件上的地址。',
            'confirmed' => '使用者已成功認證。',
            'created' => '使用者已成功新增。',
            'deleted' => '使用者已成功刪除。',
            'deleted_permanently' => '使用者被永久刪除。',
            'restored' => '使用者已成功還原。',
            'session_cleared' => '使用者的 Session 已成功清除。',
            'social_deleted' => '已成功清除社群帳號。',
            'unconfirmed' => '使用者已成功取消認證。',
            'updated' => '使用者已成功更新。',
            'updated_pa​​ssword' => '使用者密碼已成功更新。',
        ],

        'social' => [
            'cards' => [
                'cant_resend_confirmation' => '該應用程式當前設定為手動核准使用者。',
                'publish' => '文章已重新排程發佈。',
                'banned' => '文章已成功禁用。',
                'deleted' => '文章已成功刪除。',
                'deleted_permanently' => '文章被永久刪除。',
                'restored' => '文章已成功還原。',
            ],
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => '您的訊息已成功發送，我們將盡快回覆您所提供的 E-mail。',
        ],

        'social' => [
            'cards' => [
                'not_found' => '找不到您所想瀏覽的文章。',
            ],
        ],
    ],
];
