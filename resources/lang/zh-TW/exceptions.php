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
                'create_error' => '新增此角色時出現問題，請再試一次。',
                'delete_error' => '刪除此角色時出現問題，請再試一次。',
                'has_users' => '您無法刪除與關聯使用者的角色。',
                'needs_permission' => '您必須為此角色至少選擇一個權限。',
                'not_found' => '該角色不存在。',
                'update_error' => '更新此角色時出現問題，請再試一次。',
            ],

            'users' => [
                'already_confirmed' => '此使用者已認證。',
                'cant_confirm' => '認證使用者帳號時出現問題。',
                'cant_deactivate_self' => '您不能停用自己。',
                'cant_delete_admin' => '您無法刪除超級管理員。',
                'cant_delete_self' => '您不能刪除自己。',
                'cant_delete_own_session' => '您無法刪除自己的 Session。',
                'cant_restore' => '此使用者未刪除，因此無法恢復。',
                'cant_unconfirm_admin' => '您無法取消認證超級管理員。',
                'cant_unconfirm_self' => '您不能取消認證自己。',
                'create_error' => '新增此使用者時出現問題，請再試一次。',
                'delete_error' => '刪除此使用者時出現問題，請再試一次。',
                'delete_first' => '此使用者必須先刪除，才能永久銷毀。',
                'email_error' => '該電子信箱(E-mail)地址已被其它使用者使用。',
                'mark_error' => '更新此使用者時出現問題。請再試一次。',
                'not_confirmed' => '此使用者尚未認證。',
                'not_found' => '該使用者不存在。',
                'restore_error' => '還原此使用者時出現問題，請再試一次。',
                'role_needed_create' => '您必須選擇至少一個角色。',
                'role_needed' => '您必須至少選擇一個角色。',
                'social_delete_error' => '從使用者移除社群帳號時出現問題。',
                'update_error' => '更新此使用者時出現問題。請再試一次。',
                'update_password_error' => '更改此使用者密碼時出現問題。請再試一次。',
            ],
        ],

        'social' => [
            'cards' => [
                'create_error' => '新增文章時出現問題，請再試一次。',
                'update_error' => '更新文章時出現問題，請再試一次。',
                'not_found' => '該文章不存在。',
                'banned_error' => '禁用此文章時出現問題，請再試一次。',
                'banned_first' => '此文章必須先禁用，才能進行軟刪除。',
                'delete_error' => '刪除此文章時出現問題，請再試一次。',
                'delete_first' => '此文章必須先刪除，才能進行永久刪除。',
                'cant_restore' => '此文章未刪除，因此無法恢復。',
                'restore_error' => '還原此文章時出現問題，請再試一次。',
            ],

            'images' => [
                'create_error' => '新增圖片時出現問題，請再試一次。',
                'update_error' => '更新圖片時出現問題，請再試一次。',
                'not_found' => '該圖片不存在。',
            ],

            'media' => [
                'cards' => [
                    'repeated_error' => '將文章準備發表至社群平台時，發現該篇文章已經發表過了。',
                    'create_error' => '新增社群文章時出現問題，請再試一次。',
                    'update_error' => '更新社群文章時出現問題，請再試一次。',
                    'not_found' => '該社群文章不存在。',
                ],

                'comments' => [
                    'create_error' => '新增社群留言時出現問題，請再試一次。',
                    'update_error' => '更新社群留言時出現問題，請再試一次。',
                    'not_found' => '該社群留言不存在。',
                ],
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => '您的帳號已認證。',
                'confirm' => '請認證您的帳號！ ',
                'created_confirm' => '您的帳號已成功新增，我們已向您發送電子信箱(E-mail)以認證您的帳號。',
                'created_pending' => '您的帳號已成功新增並正在等待審核，您的帳號獲得審核後，系統會發送電子郵件。',
                'mismatch' => '您的認證碼不匹配。',
                'not_found' => '該認證碼並不存在。',
                'pending' => '您的帳號目前正在等待審核。',
                'resend' => '您的帳號未確認。請點擊您的電子信箱(E-mail)中的確認連結，或<a href=":url">點擊此處</a> 重新發送確認電子信箱(E-mail)。',
                'success' => '您的帳號已成功確認！ ',
                'resent' => '新的確認電子信箱(E-mail)已發送到文件上的地址。',
            ],

            'deactivated' => '您的帳號已被停用。',
            'email_taken' => '該電子信箱(E-mail)地址已被其他人使用。',

            'password' => [
                'change_mismatch' => '這不是您的舊密碼。',
                'reset_problem' => '重置密碼時出現問題，請重新發送密碼重置電子信箱(E-mail)。',
            ],

            'registration_disabled' => '註冊系統目前已關閉。',
        ],

        'social' => [
            'cards' => [
                'create_error' => '新增文章時出現問題，請再試一次。',
                'update_error' => '更新文章時出現問題，請再試一次。',
                'not_found' => '該文章不存在。',
                'review' => [
                    'not_found' => '找不到審核紀錄。',
                    'create_error' => '審核時意外失敗。',
                    'card_is_active' => '該篇文章已通過審核。',
                    'already_succeeded' => '您已經審核過了。',
                    'already_failed' => '您已經審核過了。',
                ],
            ],

            'images' => [
                'create_error' => '新增圖片時出現問題，請再試一次。',
                'update_error' => '更新圖片時出現問題，請再試一次。',
                'not_found' => '該圖片不存在。',
            ],

            'media' => [
                'cards' => [
                    'create_error' => '新增社群文章時出現問題，請再試一次。',
                    'update_error' => '更新社群文章時出現問題，請再試一次。',
                    'not_found' => '該社群文章不存在。',
                ],

                'comments' => [
                    'create_error' => '新增社群留言時出現問題，請再試一次。',
                    'update_error' => '更新社群留言時出現問題，請再試一次。',
                    'not_found' => '該社群留言不存在。',
                ],
            ],
        ],
    ],
];
