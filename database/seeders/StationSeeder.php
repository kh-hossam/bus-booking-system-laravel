<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ["name" => "Cairo"],
            ["name" => "Giza"],
            ["name" => "Alexandria"],
            ["name" => "Madīnat as Sādis min Uktūbar"],
            ["name" => "Shubrā al Khaymah"],
            ["name" => "Al Manşūrah"],
            ["name" => "Ḩalwān"],
            ["name" => "Al Maḩallah al Kubrá"],
            ["name" => "Port Said"],
            ["name" => "Suez"],
            ["name" => "Ţanţā"],
            ["name" => "Asyūţ"],
            ["name" => "Al Fayyūm"],
            ["name" => "Az Zaqāzīq"],
            ["name" => "Ismailia"],
            ["name" => "Aswān"],
            ["name" => "Kafr ad Dawwār"],
            ["name" => "Damanhūr"],
            ["name" => "Al Minyā"],
            ["name" => "Damietta"],
            ["name" => "Luxor"],
            ["name" => "Qinā"],
            ["name" => "Sūhāj"],
            ["name" => "Banī Suwayf"],
            ["name" => "Shibīn al Kawm"],
            ["name" => "Al ‘Arīsh"],
            ["name" => "Al Ghardaqah"],
            ["name" => "Banhā"],
            ["name" => "Kafr ash Shaykh"],
            ["name" => "Disūq"],
            ["name" => "Bilbays"],
            ["name" => "Mallawī"],
            ["name" => "Idfū"],
            ["name" => "Mīt Ghamr"],
            ["name" => "Munūf"],
            ["name" => "Jirjā"],
            ["name" => "Akhmīm"],
            ["name" => "Ziftá"],
            ["name" => "Samālūţ"],
            ["name" => "Manfalūţ"],
            ["name" => "Banī Mazār"],
            ["name" => "Armant"],
            ["name" => "Maghāghah"],
            ["name" => "Kawm Umbū"],
            ["name" => "Būr Fu’ād"],
            ["name" => "Al Qūşīyah"],
            ["name" => "Rosetta"],
            ["name" => "Isnā"],
            ["name" => "Maţrūḩ"],
            ["name" => "Abnūb"],
            ["name" => "Hihyā"],
            ["name" => "Samannūd"],
            ["name" => "Dandarah"],
            ["name" => "Al Khārjah"],
            ["name" => "Al Balyanā"],
            ["name" => "Maţāy"],
            ["name" => "Naj‘ Ḩammādī"],
            ["name" => "Şān al Ḩajar al Qiblīyah"],
            ["name" => "Dayr Mawās"],
            ["name" => "Ihnāsyā al Madīnah"],
            ["name" => "Darāw"],
            ["name" => "Abū Qīr"],
            ["name" => "Fāraskūr"],
            ["name" => "Ra’s Ghārib"],
            ["name" => "Al Ḩusaynīyah"],
            ["name" => "Safājā"],
            ["name" => "Qiman al ‘Arūs"],
            ["name" => "Qahā"],
            ["name" => "Al Karnak"],
            ["name" => "Hirrīyat Raznah"],
            ["name" => "Al Quşayr"],
            ["name" => "Kafr Shukr"],
            ["name" => "Sīwah"],
            ["name" => "Kafr Sa‘d"],
            ["name" => "Shārūnah"],
            ["name" => "Aţ Ţūr"],
            ["name" => "Rafaḩ"],
            ["name" => "Ash Shaykh Zuwayd"],
            ["name" => "Bi’r al ‘Abd"],
        ];

        Station::insert($cities);
    }
}
