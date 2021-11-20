<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $cities = array("Душанбе","Худжанд","Абдурахмони Джоми","Айни","Ашт","Бальджуван","Бободжон Гаффуров","Бохтар (Курган-Тюбе)","Бустон (Чкаловск)","Вандж","Варзоб","Вахдат","Вахш","Восе","Гиссар","Горная Матча","Гулистон (Кайраккум)","Дангара","Дарваз","Деваштич(Ганчи)","Джаббор Расулов","Джайхун (Кумсангир)","Джалолиддина Балхи (Руми)","Джами","Дусти (Джиликуль)","Зафарабад","Истаравшан","Истиклол","Исфара","Ишкашим","Кабодиён","Канибадам","Куляб","Кушониён (Бохтар)","Лахш(Джиргиталь)","Леваканд (Сарбанд)","Матча","Муминабад","Мургаб","Носири Хусрав","Нурабад","Нурек","Пенджикент","Пяндж","Рашт","Рогун","Рошткала","Рудаки","Рушан","Сангвор (Тавильдара)","Спитамен","Таджикабад","Темурмалик","Турсунзаде","Файзабад","Фархор","Хамадани","Ховалинг","Хорог","Хуросон","Шамсиддин Шохин (Шуроабад)","Шахринав","Шахристон","Шахритус","Шугнан","Яван");
        foreach ($cities as $city) {
            \App\Models\City::create([
                'name' => $city,
                'is_active' => true,
            ]);
        }

//        \App\Models\User::factory(10)->create();

        \App\Models\User::insert([
                'name' => 'Администратор',
                'email' => 'admin@example.com',
//                'city_id' => \App\Models\City::all()->random()->id,
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'is_active' => true,
            ]
        );

        \App\Models\User::insert([
                'name' => 'Модератор',
                'email' => 'moderator@example.com',
//                'city_id' => \App\Models\City::all()->random()->id,
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'is_active' => true,
            ]
        );

        \App\Models\User::insert([
                'name' => 'Пользователь',
                'email' => 'user@example.com',
//                'city_id' => \App\Models\City::all()->random()->id,
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'is_active' => true,
            ]
        );

        $this->call(LaratrustSeeder::class);

//        $components = array("users", "units", "categories", "products", "crudes", "warehouses", "statuses", "orders", "posts");
//        $operations = array("create", "read", "update", "delete");
//
//        foreach ($components as $component) {
//            foreach ($operations as $operation) {
//                Permission::insert([
//                    'name' => $component . '-' . $operation,
//                    'display_name' => ucwords($operation . ' ' . $component),
//                    'description' => ucwords($operation . ' ' . $component),
//                ]);
//            }
//        }

//        $roles = array(["administrator", "Administrator", "Administrator"], ["moderator", "Moderator", "Moderator"],);
//        foreach ($roles as $role) {
//            Role::insert([
//                'name' => $role[0],
//                'display_name' => $role[1],
//                'description' => $role[2],
//            ]);
//        }

        DB::table('role_user')->insert([
                'role_id' => '1',
                'user_id' => '1',
                'user_type' => 'App\Models\User',
            ]
        );

        DB::table('role_user')->insert([
                'role_id' => '2',
                'user_id' => '2',
                'user_type' => 'App\Models\User',
            ]
        );

        DB::table('role_user')->insert([
                'role_id' => '3',
                'user_id' => '3',
                'user_type' => 'App\Models\User',
            ]
        );

        \App\Models\Unit::factory(10)->create();

        \App\Models\Delivery::factory(10)->create();


        \App\Models\Crude::factory(10)->create();

//        \App\Models\ProductCrude::factory(10)->create();

        \App\Models\Warehouse::factory(10)->create();

//        \App\Models\WarehouseProduct::factory(10)->create();

//        \App\Models\Status::factory(10)->create();

        $statuses = array("не просмотрен","просмотрен","подтвержден","готов","у курьера","доставлен","выполнен");
        foreach ($statuses as $status) {
            \App\Models\Status::create([
                'name' => $status,
                'is_active' => true,
            ]);
        }



        \App\Models\Order::factory(10)->create();

//        \App\Models\OrderProduct::factory(10)->create();

//        \App\Models\Role::factory(10)->create();

//        \App\Models\RoleUser::factory(10)->create();

//        \App\Models\Permission::factory(10)->create();

//        \App\Models\PermissionRole::factory(10)->create();

//        \App\Models\PermissionUser::factory(10)->create();

        $gender = Category::create([
            "name" => "Пол",
            "resource" => "gender",
            "is_active" => 1
        ]);

        Category::create([
            "name" => "ДЕТЯМ",
            "parent_id" => $gender->id,
            "is_active" => 1
        ]);

        Category::create([
            "name" => "ЖЕНЩИНАМ",
            "parent_id" => $gender->id,
            "is_active" => 1
        ]);

        Category::create([
            "name" => "МУЖЧИНАМ",
            "parent_id" => $gender->id,
            "is_active" => 1
        ]);

        $catProducts = Category::create([
            "name" => "Категория товара",
            "resource" => "products",
            "is_active" => 1
        ]);

        Category::create([
            "name" => "Босоножки",
            "parent_id" => $catProducts->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Обувь для девочек",
            "parent_id" => $catProducts->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Обувь для мальчиков",
            "parent_id" => $catProducts->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Сумки и аксессуары",
            "parent_id" => $catProducts->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Топ-сайдеры",
            "parent_id" => $catProducts->id,
            "is_active" => 1
        ]);

        $season = Category::create([
            "name" => "Сезон",
            "resource" => "season",
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Все",
            "parent_id" => $season->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Зима",
            "parent_id" => $season->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Весна",
            "parent_id" => $season->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Лето",
            "parent_id" => $season->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Осень",
            "parent_id" => $season->id,
            "is_active" => 1
        ]);

        $color = Category::create([
            "name" => "Цвет",
            "resource" => "colors",
            "is_active" => 1
        ]);

        Category::create([
            "name" => "Чёрный",
            "parent_id" => $color->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Коричневый",
            "parent_id" => $color->id,
            "is_active" => 1
        ]);
        Category::create([
            "name" => "Белый",
            "parent_id" => $color->id,
            "is_active" => 1
        ]);

        $post = Category::create([
            "name" => "Записи",
            "resource" => "post",
            "is_active" => 1
        ]);

        Category::create([
            "name" => "Онас",
            "parent_id" => $post->id,
            "resource" => "about",
            "is_active" => 1
        ]);

        Category::create([
            "name" => "Кто носит нашу обувь",
            "parent_id" => $post->id,
            "resource" => "shoes",
            "is_active" => 1
        ]);

        Category::create([
            "name" => "Наши магазины",
            "parent_id" => $post->id,
            "is_active" => 1
        ]);

        Category::create([
            "name" => "СМИ",
            "parent_id" => $post->id,
            "resource" => "mass",
            "is_active" => 1
        ]);

        Category::create([
            "name" => "Контакты",
            "parent_id" => $post->id,
            "is_active" => 1
        ]);

        \App\Models\Product::factory(10)->create();


    }
}
