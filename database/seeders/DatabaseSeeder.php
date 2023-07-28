<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\EavAttribute;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'role_id'=>1,
            'email'=> 'admin@gmail.com',
            'password'=>bcrypt('password')
        ]);
        User::create([
            'name'=>'User',
            'role_id'=>2,
            'email'=> 'user@gmail.com',
            'password'=>bcrypt('password')
        ]);

        $first_office = new Office();
        $first_office->setTranslations('name', [
            'en' => 'Office 1',
            'ru' => 'Офис 1',
        ]);
        $first_office->price = 2000;
        $first_office->user_id = 1;
        $first_office->save();

        $second_office = new Office();
        $second_office->setTranslations('name', [
            'en' => 'Dastan',
            'ru' => 'Дастан',
        ]);
        $second_office->price = 2000;
        $second_office->user_id = 1;
        $second_office->save();

        $third_office = new Office();
        $third_office->setTranslations('name', [
            'en' => 'Amsterdam',
            'ru' => 'Астердам',
        ]);
        $third_office->price = 2000;
        $third_office->user_id = 1;
        $third_office->save();




        $eavAttribute = EavAttribute::firstOrCreate(['code' => 'services', 'name' => 'Services']);
        $first_office->services()->attach($eavAttribute, ['value' => 'Cleaning']);
        $first_office->services()->attach($eavAttribute, ['value' => 'Parking']);
        $first_office->services()->attach($eavAttribute, ['value' => 'Wifi']);


        $second_office->services()->attach($eavAttribute, ['value' => 'Cleaning']);
        $second_office->services()->attach($eavAttribute, ['value' => 'Parking']);


        $third_office->services()->attach($eavAttribute, ['value' => 'Cleaning']);
        $third_office->services()->attach($eavAttribute, ['value' => 'Wifi']);



        City::create([
            'name' => [
                'en' => 'Paris',
                'ru' => 'Париж',
            ],
        ]);
        City::create([
            'name' => [
                'en' => 'Lyon',
                'ru' => 'Лион',
            ],
        ]);
        City::create([
            'name' => [
                'en' => 'Marseille',
                'ru' => 'Марсель',
            ],
        ]);

    }
}
