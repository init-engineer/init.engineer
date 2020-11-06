<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists' => '該角色已存在，請選擇其他名稱。',
                'cant_delete_admin' => '您無法刪除管理員角色。',
                'create_error' => '建立此角色時出現問題，請再試一次。',
                'delete_error' => '刪除此角色時出現問題，請再試一次。',
                'has_users' => '您無法刪除與關聯使用者的角色。',
                'needs_permission' => '您必須為此角色至少選擇一個權限。',
                'not_found' => '該角色不存在。',
                'update_error' => '更新此角色時出現問題。請再試一次。',
            ],

            'users' => [
                'already_confirmed' => '該使用者已被認證。',
                'cant_confirm' => '認證使用者帳號時出現問題。',
                'cant_deactivate_self' => '您不能停用自己。',
                'cant_delete_admin' => '您無法刪除超級管理員。',
                'cant_delete_self' => '您不能刪除自己。',
                'cant_delete_own_session' => '您無法刪除自己的 Session。',
                'cant_restore' => '此使用者未刪除，因此無法恢復。',
                'cant_unconfirm_admin' => '您不能取消認證超級管理員。',
                'cant_unconfirm_self' => '您不能取消認證自己。',
                'create_error' => '建立此使用者時出現問題，請再試一次。',
                'delete_error' => '刪除此使用者時出現問題，請再試一次。',
                'delete_first' => '此使用者必須先刪除，才能永久刪除。',
                'email_error' => '該電子信箱地址已被其它使用者使用。',
                'mark_error' => '更新此使用者時出現問題，請再試一次。',
                'not_confirmed' => '該使用者尚未認證。',
                'not_found' => '該使用者不存在。',
                'restore_error' => '還原此使用者時出現問題，請再試一次。',
                'role_needed_create' => '您必須選擇至少一個角色。',
                'role_needed' => '您必須至少選擇一個角色。',
                'social_delete_error' => '從使用者刪除社群帳號時出現問題。',
                'update_error' => '更新此使用者時出現問題，請再試一次。',
                'update_password_error' => '更改此使用者密碼時出現問題，請再試一次。',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => '您的帳號已認證。',
                'confirm' => '認證您的帳號！',
                'created_confirm' => '您的帳號已成功建立，我們已向您發送電子信箱以認證您的帳號。',
                'created_pending' => '您的帳號已成功建立，正在等待審核，您的帳號審核通過後，將會發送一封電子信箱給您。',
                'mismatch' => '您的驗證碼不匹配。',
                'not_found' => '該認證碼不存在。',
                'pending' => '您的帳號目前正在等待審核。',
                'resend' => '您的帳號未認證，請點擊您的電子信箱中的驗證連結，或<a href=":url">點擊此處</a>來重新發送認證電子信箱。',
                'success' => '您的帳號已成功認證！',
                'resent' => '新的認證電子信箱已發送到文件上的地址。',
            ],

            'deactivated' => '您的帳號已被停用。',
            'email_taken' => '該電子信箱地址已被佔用。',

            'password' => [
                'change_mismatch' => '這不是您的舊密碼。',
                'reset_problem' => '重置密碼時出現問題，請重新發送密碼重置電子信箱。',
            ],

            'registration_disabled' => '註冊目前已關閉。',
        ],
    ],
];
