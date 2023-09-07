<?php

return [
    'date' => [
        'slash' => [
            'Ymd' => 'Y/m/d',
            'YmdHi' => 'Y/m/d H:i'
        ],
        'dash' => [
            'Ymd' => 'Y-m-d'
        ]
    ],
    'image_host' => env('IMAGE_HOST'),
    'format_date_Y-m-d_H' => 'Y-m-d H',
    'format_date_Y-m-d_H_i_s' => 'Y-m-d H:i:s',
    'format_H_i_s' => 'H:i:s',
    'format_H_i' => 'H:i',
    'format_Y年m月d日H時' => 'Y年m月d日 H時',
    'email_admin' => env('ADMIN_EMAIL', 'admin@example.com'),
    'password_admin' => env('ADMIN_PASSWORD', ''),
    'password_reset_token_expiries' => env('PASSWORD_RESET_TOKEN_EXPIRIES', 1), // hour
    'url_reset_password_user' => env('URL_RESET_PASSWORD_USER', 'http://127.0.0.1:3000/reset-password'),
    'email_support' => env('EMAIL_SUPPORT', 'supportmail@hare.co.jp'),
    'common_per_page' => 10,
    'common_on_each_size' => 1,
    'api_key_map' => env('PUBLIC_API_KEY_GOOGLE'),
    'avatar_image_directory' => 'images/avatar',
    'message_upload_image_directory' => 'images/messages',
    'message_upload_attachment_directory' => 'attachments/messages',
    'url_login_user' => env('URL_LOGIN_USER'),
    'fee_with_tax_multiplier' => 1.1,
    'fee_no_tax_multiplier' => 1,
    'per_page' => [
        'six' => '6',
        'three' => '3'
    ],
    'channel_has_zero_value' => 0,
];
