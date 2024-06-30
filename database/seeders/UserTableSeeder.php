<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name'=>'abdulhamed_zaghloul',
           'email'=>'abdulhamed_zaghloul@gmail.com',
           'password'=>bcrypt('102030'),
        ]);

        User::create([
            'name'=>'ali_adam',
            'email'=>'ali@gmail.com',
            'password'=>bcrypt('102030'),
        ]);
        User::create([
            'name'=>'adam_ahamed',
            'email'=>'adam@gmail.com',
            'password'=>bcrypt('102030'),
        ]);
    }
}
