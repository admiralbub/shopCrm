<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            /*[
                'name_ua'=>"Назва сайта (RU)",
                'name_ru'=>"Название сайта (RU)",
                'key' => 'site_name_ru', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Назва сайта (UA)",
                'name_ru'=>"Название сайта (UA)",
                'key' => 'site_name_ua', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Телефон",
                'name_ru'=>"Телефон",
                'key' => 'phone_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Текстовий блок у шапку лівий верхній кут: (RU)",
                'name_ru'=>"Текстовый блок в шапку левый верхний угол: (RU)",
                'key' => 'text_left_site_ru', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Текстовий блок у шапку лівий верхній кут: (UA)",
                'name_ru'=>"Текстовый блок в шапку левый верхний угол: (UA)",
                'key' => 'text_left_site_ua', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Логотип",
                'name_ru'=>"Логотип",
                'key' => 'logo_site', 
                'value' => '',
                'type'=>'picture'
            ],
            [
                'name_ua'=>"Короткий опис (UA)",
                'name_ru'=>"Краткое описание (UA)",
                'key' => 'description_site_ua', 
                'value' => '',
                'type'=>'text'
            ],
            [
                'name_ua'=>"Короткий опис (RU)",
                'name_ru'=>"Краткое описание (RU)",
                'key' => 'description_site_ru', 
                'value' => '',
                'type'=>'text'
            ],
            [
                'name_ua'=>"Youtube",
                'name_ru'=>"Youtube",
                'key' => 'youtube_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Telegram",
                'name_ru'=>"Telegram",
                'key' => 'telegram_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Facebook",
                'name_ru'=>"Facebook",
                'key' => 'facebook_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Instagram",
                'name_ru'=>"Instagram",
                'key' => 'instagram_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Tiktok",
                'name_ru'=>"Tiktok",
                'key' => 'tiktok_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Viber",
                'name_ru'=>"Viber",
                'key' => 'viber_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Copyright",
                'name_ru'=>"Copyright",
                'key' => 'copyright_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Email",
                'name_ru'=>"Email",
                'key' => 'email_site', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Адреса компанії (UA)",
                'name_ru'=>"Адрес компании (UA)",
                'key' => 'adress_site_ua', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Адреса компанії (RU)",
                'name_ru'=>"Адрес компании (RU)",
                'key' => 'adress_site_ru', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Посилання на адреса компанії",
                'name_ru'=>"Ссылка на адрес компании",
                'key' => 'link_adress_site', 
                'value' => '',
                'type'=>'field'
            ],*/
            [
                'name_ua'=>"",
                'name_ru'=>"Ссылка на адрес компании",
                'key' => 'info_viewproduct_ru', 
                'value' => '',
                'type'=>'Editor'
            ],
            [
                'name_ua'=>"Посилання на адреса компанії",
                'name_ru'=>"Ссылка на адрес компании",
                'key' => 'info_viewproduct_ua', 
                'value' => '',
                'type'=>'Editor'
            ]
           
        ];
 
        Setting::insert($settings);
    }
}
