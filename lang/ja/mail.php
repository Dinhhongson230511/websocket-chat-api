<?php

return [
    'subject' => [
        'user' => [
            'signup' => [
                'success' => '',
                'profile_success' => ''
            ]
        ],
        'admin' => [
            'signup_user' => [
                'success' => ''
            ]
        ],
        'create_account' => '【HARE】アカウント発行のお知らせ',
        'reset_password' => '【HARE】アカウント発行のお知らせ',
        'register_agencies_travel' => '旅行会社アカウント発行のお知らせ',
        'register_company' => '会員登録が完了しました。管理者の承認をお待ちください。',
    ],
    'body' => [
        'user' => [
            'signup' => [
                'success' => '',
                'profile_success' => ''
            ]
        ],
        'admin' => [
            'signup_user' => [
                'success' => ''
            ]
        ],
        'reset_password' => [
            'success' => ':name 様<br/><br/>
            HAREのアカウントを発行しました。<br/>
            ■ID： :email <br/><br/>
            下記URLからログイン・パスワードの再設定をしてください。<br/>
            <a href=":url" target="_blank">:url</a>
            '
        ],
        'register_agencies_travel' => [
            'success' => ':name 様<br/><br/>
            旅行会社のアカウントを発行いたしました。<br/>
            以下の情報をご確認いただき、ログイン手続きをお願い申し上げます。<br/><br/>
            ■ID: :emailAddress<br/>
            ■仮パスワード: :password<br/><br/>
            ログイン後、下記URLから仮パスワードの本設定を行なってください。<br/>
            (<a href=":url" target="_blank">:url</a>)<br/><br/>
            ご注意いただきたいのは、IDおよびパスワードは、旅行会社へのログインに必要な情報です。<br/><br/>
            大切に保管していただき、セキュリティに気を配ってご利用ください。<br/><br/>
            何か疑問点やご不明点がございましたら、お気軽に以下のアドレスまでお問い合わせください。<br/>
            '
        ],
        'register_user_store' => [
            'success' => ':name 様<br/><br/>
            飲食店のアカウントを発行いたしました。<br/>
            以下の情報をご確認いただき、ログイン手続きをお願い申し上げます。<br/><br/>
            ■ID: :email<br/>
            ■仮パスワード: :password<br/><br/>
            ログイン後、下記URLから仮パスワードの本設定を行なってください。<br/>
            (<a href=":url" target="_blank">:url</a>)<br/><br/>
            ご注意いただきたいのは、IDおよびパスワードは、飲食店へのログインに必要な情報です。<br/><br/>
            大切に保管していただき、セキュリティに気を配ってご利用ください。<br/><br/>
            何か疑問点やご不明点がございましたら、お気軽に以下のアドレスまでお問い合わせください。<br/>
            '
        ],
        'register_company' => [
            'success' => ':name 様<br/><br/>
            Password: :password<br/><br/>
            いつも当サイトをご利用いただき、誠にありがとうございます。<br/><br/>
            このたび、会員登録が正常に完了いたしました。ただし、現時点では管理者の承認を受ける必要があります。<br/><br/>
            登録情報が管理者によって確認・承認されるまで、一時的にご利用いただくことはできません。通常、承認には1〜2営業日かかることがございますので、しばらくお待ちいただけますようお願い申し上げます。<br/><br/>
            承認が完了いたしましたら、登録完了のメールをお送りいたします。それまで少々お待ちください。<br/><br/>
            '
        ],
        'register_account' => [
            'success' => ':name様<br/><br/>
            HAREのアカウントを発行しました。<br/><br/>
            ■ID： :email<br/><br/>
            ■パスワード： :password<br/><br/>
            下記URLからログイン・パスワードの再設定をしてください。<br/><br/>
            :url<br/><br/>
            IDおよびパスワードは、HAREへのログインに必要です。<br/>
            忘れずに保管をお願いします。<br/><br/>
            '
        ]
    ],
    'footer' => '<br/>
        メールアドレス： :email <br/>
        ※なお、本メールはシステムからの自動送信ですので、返信はできません。<br/><br/>
        株式会社HARE
    ',
];
