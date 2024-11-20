<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $userdata = [
        [
            "name"=> "Kepala Lab",
            "email"=> "kepalalab@gmail.com",
            "NIP"=> "243464726264647",
            "role"=> "Kepalalab",
            "password"=> bcrypt("12345678"),
        ],

        [
            "name"=> "Staff",
            "email"=> "staff@gmail.com",
            "NIP"=> "12638738647637676",
            "role"=> "Staff",
            "password"=> bcrypt("12345678"),
        ],

        [
            "name"=> "Teknisi",
            "email"=> "teknisi@gmail.com",
            "role"=> "Teknisi",
            "password"=> bcrypt("12345678"),
        ],
    ];

    foreach($userdata as $key => $val){
        User::create($val);
    }
    }
}
