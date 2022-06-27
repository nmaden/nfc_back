<?php

namespace Database\Seeders;

use App\Models\Attributes;
use App\Models\Cities;
use App\Models\Citites;
use App\Models\Office;
use App\Models\User;
use Attribute;
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
   

        Office::create([
            'name'=>'Office 1',
            'price'=>'2000',
            'user_id'=>1
        ]);
        Office::create([
            'name'=>'Office 2',
            'price'=>'3000',
            'user_id'=>2
        ]);
        Office::create([
            'name'=>'Office 3',
            'price'=>'4000',
            'user_id'=>2
        ]);


        Cities::create([
            'name_ru'=>'Париж',
            'name_eng'=>'Paris'
        ]);
        Cities::create([
            'name_ru'=>'Лион',
            'name_eng'=>'Lyon'
        ]);
        Cities::create([
            'name_ru'=>'Марсель',
            'name_eng'=>'Marseille'
        ]);
        

        Attributes::create([
            'office_id'=>1,
            'area'=>200,
            'city_id'=>1,
            'count_seats'=>10,
            'wifi'=>true,
            'coffee_machine'=> true,
            'tv'=>false
        ]);
        Attributes::create([
            'office_id'=>2,
            'area'=>200,
            'city_id'=>2,
            'count_seats'=>20,
            'wifi'=>false,
            'coffee_machine'=> true,
            'tv'=>true
        ]);
        Attributes::create([
            'office_id'=>3,
            'area'=>200,
            'city_id'=>3,
            'count_seats'=>30,
            'wifi'=>true,
            'coffee_machine'=> true,
            'tv'=>true
        ]);
    }
}
