<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Holiday;
use App\Models\Store;
use App\Models\StoreImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultThreeStoreSeed extends Seeder
{
    private const DATA_STORE = [
        [
            'name' => 'テスト店舗1',
            'furigana' => 'テストテンポ1',
            'post_code' => '106-0045',
            'prefecture_id' => '2',
            'area_id' => '12',
            'sub_area_id' => '63',
            'address_lines' => '四谷1-6-1 四谷ﾀﾜｰｺﾓﾚﾓｰﾙ212',
            'tel' => '03-5798-3211',
            'fax' => '0166-55-2242',
            'email' => 'ngoc.dtb@haposoft.com',
            'lat' => '35.7785802',
            'long' => '135.9557378',
            'store_dish' => ['3', '18', '38', '70'],
            'max_people' => '99',
            'smoking_policy' => '禁煙',
            'parking' => '有り',
            'parking_remarks' => '東京メトロ丸ノ内線 ／ 新宿三丁目駅 徒歩3分（230m）東京メトロ丸ノ内線 ／ 新宿御苑前駅 徒歩8分（600m）JR山手線 ／ 新宿駅 徒歩9分（720m）',
            'boarding_place' => '乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所',
            'allergy_compatibility' => ['1'],
            'dietary_restrictions' => ['1'],
            'cp' => '有り',
            'holidays' => [
                [
                    'day_of_week' => '日曜日',
                    'start_time' => '2023/10/20 14:00',
                    'end_time' => '2023/10/20 15:00',
                ],
                [
                    'day_of_week' => '火曜日',
                    'start_time' => '2023-11-20 00:00',
                    'end_time' => '2023-11-20 23:59',
                ],
            ],
            'store_images' => [
                [
                    'source_url' => 'images/thumbnail/food_example_2.png',
                    'type' => '内観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_3.png',
                    'type' => '外観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_3.png',
                    'type' => '外観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_4.png',
                    'type' => '料理の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_4.png',
                    'type' => '料理の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/layout_diagram',
                    'type' => 'レイアウト図',
                ],
                [
                    'source_url' => 'images/thumbnail/layout_diagram',
                    'type' => 'レイアウト図',
                ],
            ],
            'room_seat_type' => ['1', '2', '3']

        ],
        [
            'name' => 'テスト店舗2',
            'furigana' => 'テストテンポ2',
            'post_code' => '107-0062',
            'prefecture_id' => '1',
            'area_id' => '2',
            'sub_area_id' => '10',
            'address_lines' => '麻布十番２丁目２０−２',
            'tel' => '03-5798-3222',
            'fax' => '0177-55-2242',
            'email' => 'congbv@haposoft.com',
            'lat' => '37.6485777681006',
            'long' => '139.676161414504',
            'store_dish' => ['76', '84', '93', '114'],
            'max_people' => '77',
            'smoking_policy' => '分煙',
            'parking' => '無し',
            'parking_remarks' => '都営大江戸線 ／ 新宿西口駅 徒歩3分（210m）東京メトロ丸ノ内線 ／ 新宿三丁目駅 徒歩3分（210m）JR山手線 ／ 新宿駅 徒歩3分（210m）',
            'boarding_place' => '乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所',
            'allergy_compatibility' => ['2'],
            'dietary_restrictions' => ['1'],
            'cp' => '無し',
            'holidays' => [
                [
                    'day_of_week' => '月曜日',
                    'start_time' => '2023-05-12 14:00',
                    'end_time' => '2023-05-12 15:30',
                ],
                [
                    'day_of_week' => '日曜日',
                    'start_time' => '2023-08-12 14:00',
                    'end_time' => '2023-08-12 15:00',
                ],
            ],
            'store_images' => [
                [
                    'source_url' => 'images/thumbnail/food_example_2.png',
                    'type' => '内観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_3.png',
                    'type' => '外観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_3.png',
                    'type' => '外観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_4.png',
                    'type' => '料理の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_4.png',
                    'type' => '料理の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/layout_diagram',
                    'type' => 'レイアウト図',
                ],
                [
                    'source_url' => 'images/thumbnail/layout_diagram',
                    'type' => 'レイアウト図',
                ],
            ],
            'room_seat_type' => ['1', '2', '3']

        ],
        [
            'name' => 'テスト店舗3',
            'furigana' => 'テストテンポ3',
            'post_code' => '107-0009',
            'prefecture_id' => '2',
            'area_id' => '12',
            'sub_area_id' => '64',
            'address_lines' => '広尾５丁目１６−１',
            'tel' => '03-5798-3233',
            'fax' => '0188-55-2242',
            'email' => 'sang.htt@haposoft.com',
            'lat' => '43.1116932502514',
            'long' => '142.499385286448',
            'store_dish' => ['107', '127', '117', '150', '162'],
            'max_people' => '88',
            'smoking_policy' => '喫煙',
            'parking' => '有り',
            'parking_remarks' => '都営大江戸線 ／ 新宿西口駅 徒歩3分（200m）JR山手線 ／ 新宿駅 徒歩3分（200m）東京メトロ丸ノ内線 ／ 新宿三丁目駅 徒歩3分（200m）',
            'boarding_place' => '乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所乗降場所',
            'allergy_compatibility' => ['1', '2', '3'],
            'dietary_restrictions' => ['1'],
            'cp' => '無し',
            'holidays' => [
                [
                    'day_of_week' => '月曜日',
                    'start_time' => '2023-11-07 14:30',
                    'end_time' => '2023-11-07 15:30',
                ],
                [
                    'day_of_week' => '日曜日',
                    'start_time' => '2023-12-12 14:00',
                    'end_time' => '2023-12-12 15:00',
                ],
            ],
            'store_images' => [
                [
                    'source_url' => 'images/thumbnail/food_example_2.png',
                    'type' => '内観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_3.png',
                    'type' => '外観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_3.png',
                    'type' => '外観の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_4.png',
                    'type' => '料理の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/food_example_4.png',
                    'type' => '料理の画像',
                ],
                [
                    'source_url' => 'images/thumbnail/layout_diagram',
                    'type' => 'レイアウト図',
                ],
                [
                    'source_url' => 'images/thumbnail/layout_diagram',
                    'type' => 'レイアウト図',
                ],
            ],
            'room_seat_type' => ['1', '2', '3']

        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $company = $this->createCompany();
            $dataHolidays = [];
            $dataStoreImages = [];
            foreach (self::DATA_STORE as $key => $storeItem) {
                $store = Store::create([
                    'company_id' => $company->id,
                    'name' => $storeItem['name'],
                    'furigana' => $storeItem['furigana'],
                    'post_code' => $storeItem['post_code'],
                    'prefecture_id' => $storeItem['prefecture_id'],
                    'area_id' => $storeItem['area_id'],
                    'sub_area_id' => $storeItem['sub_area_id'],
                    'address_lines' => $storeItem['address_lines'],
                    'tel' => $storeItem['tel'],
                    'fax' => $storeItem['fax'],
                    'email' => $storeItem['email'],
                    'lat' => $storeItem['lat'],
                    'long' => $storeItem['long'],
                    'max_people' => $storeItem['max_people'],
                    'smoking_policy' => $storeItem['smoking_policy'],
                    'parking' => $storeItem['parking'],
                    'parking_remarks' => $storeItem['parking_remarks'],
                    'boarding_place' => $storeItem['boarding_place'],
                    'cp' => $storeItem['cp'],
                ]);
                $store->allergyCompatibilities()->sync($storeItem['allergy_compatibility']);
                $store->dietaryRestrictions()->sync($storeItem['dietary_restrictions']);
                $store->dishes()->sync($storeItem['store_dish']);
                $store->roomSeatTypes()->sync($storeItem['room_seat_type']);
                foreach ($storeItem['holidays'] as $holiday) {
                    $dataHolidays = [
                        ...$dataHolidays,
                        [
                            'store_id' => $key + 1,
                            ...$holiday
                        ],
                    ];
                }
                foreach ($storeItem['store_images'] as $key => $image) {
                    $dataStoreImages = [
                        ...$dataStoreImages,
                        [
                            'store_id' => $store->id,
                            'order_id' => $key + 1,
                            ...$image
                        ]
                    ];
                }
            }
            StoreImage::query()->upsert($dataStoreImages, '', ['store_id', 'order_id', 'type', 'source_url']);
            Holiday::query()->upsert($dataHolidays, '', ['store_id', 'day_of_week', 'start_time', 'end_time']);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    private function createCompany(): Company
    {
        $company = Company::factory()->create([
            'name' => 'はぽ',
            'furigana_name' => 'ハポ',
            'tel' => '0987878877',
            'fax' => '09878788',
            'post_code' => '1243356',
            'prefecture' => '北海道',
            'locality' => '札幌',
            'address_lines' => 'その他南区',
            'approval_status' => 2,
            'approved_by_id' => 1
        ]);
        $user = User::factory()->company()->create([
            'first_name' => 'UserCompany',
            'email' => 'userCompany@gmail.com',
            'password' => 'User@123',
            'company_id' => $company->id
        ]);

        $company->update([
            'manager_id' => $user->id
        ]);
        return $company;
    }
}
