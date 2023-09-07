<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'アカウントが存在しません。',
    'login' => [
        'title' => 'ログイン',
        'input' => [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ],
        'button' => [
            'submit' => 'ログイン',
            'remember_token' => 'ログイン状態を保存する',
            'reset_password' => 'パスワードをお忘れの場合はこちら'
        ],
    ],
    'message' => [
        'login' => [
            'success' => 'ログインに成功しました。',
            'error' => 'メールアドレスまたはパスワードが正しくありません。',
            'account_not_exist' => 'アカウントが存在しません。',
        ],
        'logout' => [
            'success' => 'ログアウトに成功しました。',
            'error' => 'ログアウトに失敗しました。'
        ],
        'reset_password' => [
            'error' => 'リフレッシュトークンの有効期限を切りました。',
            'success' => 'パスワード再設定が完了しました',
            'send_mail_success' => 'パスワード再設定の受付を完了しました、メールをご確認ください。ご不明点やお困りごとがございましたら、お気軽にお問い合わせください。',
            'send_mail_error' => 'メールの送信に失敗しました。もう一度お試してください。',
        ],
        'change_password' => [
            'error' => 'パスワード強制が失敗しました',
            'success' => 'パスワード強制が完了しました'
        ]
    ],
    'reset_password' => [
        'title' => 'パスワード再設定',
        'descriptions' => 'パスワードを再設定します。<br>ご登録されている内容を入力してください。',
        'message' => [
            'send_mail_success' => 'ご登録したメールアドレスに案内を送信しました。 メールに記載されたご案内に従い、パスワードの再設定を行ってください。',
            'send_mail_error' => 'メールの送信に失敗しました。もう一度お試してください。',
            'token_fail' => ' パスワードリセットのリンクの期限が切れています。新たにリクエストしてください。',
            'success' => 'パスワードの変更に成功しました。',
            'error' => 'パスワードの変更に失敗しました'
        ],
        'button' => [
            'submit' => '再設定',
        ],
    ],
    'new_password' => [
        'title' => 'パスワード変更',
        'suggestion' => 'パスワードは 数字・英大文字・英小文字・記号 のうち3種類を使用し 8桁以上で設定して下さい。',
        'input' => [
            'new_password' => '新規のパスワード',
            'password_confirm' => '新規のパスワード（確認）'
        ],
        'button' => [
            'reset' => '変更',
        ]
    ],
    'common' => [
        'btn_back' => '戻る'
    ]
];
