<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Dish;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private const CATEGORIES = [
        '和食' => [
            'すし・魚料理' => [
                '寿司',
                '魚介・海鮮料理',
                '回転寿司',
                '海鮮丼',
                '刺身',
                'かに料理',
                'ふぐ料理',
                'すっぽん料理',
                'オイスターバー',
                'うなぎ',
            ],
            '和食・日本料理' => [
                'おでん',
                '和食',
                '日本料理',
                '割烹・小料理屋',
                '料亭',
                '懐石料理',
                '精進料理',
                'おばんざい',
                '湯豆腐',
                '豆腐料理・湯葉料理',
                '釜飯',
                '会席料理',
                '季節料理',
                'くじら料理',
                '天ぷら',
            ],
            'ラーメン・麺類' => [
                'そば（蕎麦）',
                'うどん',
                '担々麺',
                '刀削麺',
                '讃岐うどん',
                'カレーうどん',
                'ちゃんぽん',
                '冷麺',
                '油そば',
                'B級麺料理',
                '焼きそば',
                'ラーメン',
                '味噌ラーメン',
                '家系ラーメン',
                '二郎系ラーメン',
                'つけ麺',
                'とんこつラーメン',
                '塩ラーメン',
            ],
            '丼もの・揚げ物' => [
                '丼もの',
                '親子丼',
                '牛丼',
                '天丼',
                'カツ丼',
                '定食',
                'しらす丼',
                '穴子丼',
                'とんかつ',
                'からあげ',
                '味噌カツ',
            ],
            'お好み焼・粉物' => [
                'たこ焼き',
                '明石焼き',
                'お好み焼き',
                'もんじゃ焼き',
            ],
            '郷土料理' => [
                '京料理',
                'ひつまぶし',
                'ほうとう',
                'しっぽく料理',
                '北海道料理',
                'ご当地グルメ',
                '沖縄そば',
                '沖縄料理',
                '郷土料理',
                '九州料理',
            ]
        ],
        'アジア料理' => [
            'アジア・エスニック' => [
                'インドネシア料理',
                'ベトナム料理',
                'インド料理',
                'ネパール料理',
                'トルコ料理',
                'メキシコ料理',
                'シュラスコ',
                'シンガポール料理',
                'マレーシア料理',
                '韓国料理',
                'タイ料理',
                'パクチー料理',
                'インドカレー',
            ],
            '中華' => [
                '四川料理',
                '広東料理',
                '北京料理',
                '上海料理・上海蟹',
                '台湾料理',
                'チャーハン',
                '飲茶・点心',
                '小龍包',
                '餃子',
            ]
        ],
        'ヨーロッパ料理' => [
            'イタリアン' => [
                'イタリア料理',
                'パスタ',
                'イタリアンバル',
                'ピザ',
            ],
            '洋食・西洋料理' => [
                'チーズ料理',
                'スープカレー',
                'ハヤシライス',
                'オムライス',
                'スープ',
                'シチュー',
                'チーズフォンデュ',
                'ドイツ料理',
                'ロシア料理',
                'ハワイ料理',
                '洋食',
                'スペイン料理',
                'ハンバーグ',
                'ハンバーガー',
                'カレー',
                '洋風なおかず',
            ],
            'フレンチ' => [
                'ビストロ',
                'ジビエ',
                'フランス料理',
            ],
            'アメリカ料理' => [
                'カリフォルニア料理',
                'ケイジャン料理',
            ],
            'アフリカ料理' => [
                'エジプト料理',
                'モロッコ料理',
            ],
            '珍しい各国料理' => [
                'スリランカ料理',
                'パキスタン料理',
                'アラビア料理',
                'オーストラリア料理',
                'カリブ料理',
                '南米料理',
                '無国籍料理',
            ]
        ],
        '肉料理' => [
            '焼肉・ステーキ' => [
                '牛タン',
                'ジンギスカン',
                'サムギョプサル',
                '鉄板焼き',
                'チーズタッカルビ',
                'ステーキ',
                '焼肉',
                'ホルモン',
            ],
            '焼鳥・串料理' => [
                '炉端焼き',
                '串カツ',
                '焼き鳥',
                '串揚げ',
            ],
            'こだわりの肉料理' => [
                '牛料理',
                '豚料理',
                '鶏料理',
                '馬肉料理',
                '熟成肉',
                '羊肉',
                'もつ料理',
                '串焼き',
                '炭火焼き',
                'バーベキュー',
                'ローストビーフ丼',
            ]
        ],
        '鍋料理' => [
            '鍋' => [
                'きりたんぽ鍋',
                'ちゃんこ鍋',
                '水炊き',
                '火鍋',
                'あんこう鍋',
                'タジン鍋',
                'カレー鍋',
                'うどんすき',
                '鍋',
                'もつ鍋',
                '韓国鍋',
                '珍しい鍋',
            ],
            'しゃぶしゃぶ・すき焼き' => [
                'すき焼き',
                'かにしゃぶ',
                'しゃぶしゃぶ',
            ]
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        SubCategory::truncate();
        Dish::truncate();
        foreach (self::CATEGORIES as $categoryName => $subCategories) {
            $category = Category::create(['name' => $categoryName]);
            $this->createSubCategory($category, $subCategories);
        }
    }

    /**
     * createSubCategory
     *
     * @param  Category $category
     * @param  array $subCategories
     * @return void
     */
    public function createSubCategory(Category $category, array $subCategories): void
    {
        if (count($subCategories)) {
            foreach ($subCategories as $subCategoryName => $dishes) {
                $subCategory = SubCategory::create([
                    'name' => $subCategoryName,
                    'category_id' => $category->id,
                ]);
                $this->createDish($subCategory, $dishes);
            }
        }
    }

    /**
     * createDish
     *
     * @param  SubCategory $subCategory
     * @param  array $dishes
     * @return void
     */
    public function createDish(SubCategory $subCategory, array $dishes): void
    {
        if (count($dishes)) {
            foreach ($dishes as $dish) {
                Dish::create([
                    'name' => $dish,
                    'sub_category_id' => $subCategory->id,
                ]);
            }
        }
    }
}
