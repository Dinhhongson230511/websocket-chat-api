<?php

return [
    'no' => 'No',
    'date' => '日付',
    'company_name' => '会社名',
    'store_name' => '店名',
    'manager' => '担当者',
    'phone' => 'TEL',
    'email' => '担当者メール',
    'action' => 'アクション',
    'area' => 'エリア',
    'title' => '企業情報',
    'address_title' => '住所',
    'status' => 'ステータス',
    'request' => '確認中',
    'approved' => '承認済',
    'rejected' => '拒否されました',
    'reservation_results' => '予約実績',
    'information_details' => '情報詳細',
    'option_name_default_comapny' => '会社名を選択して下さい',
    'option_name_default_area' => 'エリア',
    'option_name_default_reservation_period' => '予約期間',
    'search_store_name_placeholder' => '店舗名を選択してください。',
    'btn' => [
        'save' => '編集',
        'back' => '戻る',
        'map' => 'マップ上で選択',
        'get_lat_lng' => '保存',
        'reservation_list' => '予約一覧',
    ],
    'table' => [
        'title' => '代理店新規登録',
        'btn' => [
            'detail' => '詳細',
            'delete' => '削除',
        ],
    ],
    'label' => [
        'no' => 'No',
        'title' => '旅行会社新規登録詳細',
        'corporate_information' => '企業情報',
        'name' => '法人名',
        'furigana_name' => '法人名フリガナ',
        'tel' => 'TEL',
        'fax' => 'FAX',
        'post_code' => '郵便番号',
        'prefecture' => '都道府県',
        'locality' => '市区郡',
        'address_lines' => '町名番地以下',
        'store_detail' => '店舗詳細',
        'reservation_list' => '予約一覧',
        'store_name' => '店舗名',
        'area' => 'エリア',
    ],
    'title' => '店舗登録',
    'sidebar' => '飲食店一覧',
    'button' => [
        'create' => '店舗情報登録',
        'cancel' => 'キャンセル'
    ],
    'modal' => [
        'title' => 'アイコン位置設定'
    ],
    'message' => [
        'no_content' => 'この郵便番号の住所は見つかりませんでした。',
        'api_gg_error' => 'Google Maps API の呼び出し中にエラーが発生しました。 後でもう一度試してください。',
        'not_found_address' => "検索が正しく入力されていることを確認してください。市町村、都道府県、または郵便番号を追加してみてください。",
        'only_select_3_items' => '3つの項目しか選択できません。'
    ],
    'card' => [
        'info' => [
            'title' => '店舗情報',
            'content' => [
                'name' => '店舗名',
                'furigana' => '店舗名フリガナ',
                'area' => 'エリア',
                'prefecture' => '都道府県',
                'locality' => '市区郡',
                'email' => 'メール',
                'post_code' => '郵便番号',
                'tel' => 'TEL',
                'fax' => 'FAX',
                'lat' => '緯度',
                'long' => '経度 ',
                'address_lines' => '町名番地以下',
                'max_people' => '団体受け入れ最大人数',
                'parking_remarks' => '駐車場備考',
                'boarding_place' => '乗降場所',
                'btn_search_postcode' => '検索',
                'room_seat_type' => '個室＆席タイプ',
                'smoking_policy' => '喫煙',
                'parking' => '駐車場',
                'type' => 'ジャンル',
                'business_hours' => '営業時間',
                'allergy_friendly' => 'アレルギー対応',
                'dietary_restrictions' => '食事制限',
                'available_days' => '定休日時',
            ],
            'placeholder' => [
                'name' => '店舗名を入力してください',
                'furigana' => '店舗名フリガナを入力してください',
                'post_code' => '郵便番号を入力してください',
                'area' => 'エリア',
                'locality' => '市区郡',
                'prefecture' => '都道府県',
                'tel' => 'TELを入力してください',
                'fax' => 'FAXを入力してください',
                'email' => 'メールを入力してください',
                'max_people' => '最大人数を選択してください',
                'parking_remarks' => '駐車場備考を入力してください',
                'boarding_place' => '乗降場所を入力してください'
            ],
            'radio' => [
                'smoking_policy' => [
                    'no_smoking' => '禁煙',
                    'smoking' => '喫煙',
                    'area_smoking' => '分煙',
                ],
                'yes' => '有り',
                'no' => '無し'
            ]
        ],
        'detail' => [
            'title' => '店舗詳細',
            'images' => [
                'thumbnail' => 'サムネイル',
                'exterior' => '外観の画像',
                'interior' => '内観の画像',
                'cooking' => '料理の画像',
                'layout' => 'レイアウト図',
            ],
            'radio' => [
                'smoking_policy' => [
                    'no_smoking' => '禁煙',
                    'smoking' => '喫煙',
                    'area_smoking' => '分煙',
                ],
                'yes' => '有り',
                'no' => '無し',
                'tc_dg_same_food' => [
                    'title' => 'TC・DG同食料金',
                    'same_amount' => '同額',
                    'half' => '半額',
                    'others' => 'その他',
                ],
                'tc_dg_special_food' => [
                    'title' => 'TC・DG別食料金',
                ],
            ],
            'cp' => 'CP対象',
            'holiday' => [
                'label' => '定休日時'
            ]
        ],
        'user' => [
            'title' => '店舗担当者追加',
            'input' => [
                'avatar' => '写真選択',
                'last_name' => '姓',
                'first_name' => '名',
                'furigana_last_name' => '姓フリガナ',
                'furigana_first_name' => '名フリガナ',
                'email' => 'メール',
                'tel' => 'TEL',
                'fax' => 'FAX',
            ],
            'placeholder' => [
                'last_name' => '鈴木',
                'first_name' => '太郎',
                'furigana_last_name' => 'スズキ',
                'furigana_first_name' => 'タロウ',
                'email' => 'tarou@gmail.com',
                'tel' => '0123-4567-891',
                'fax' => '0123-4567-89',
            ]
        ]
    ]
];
