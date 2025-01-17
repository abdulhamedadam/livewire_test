<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory=Factory::create();
        for($i=1;$i<=15;$i++){
            Post::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'category_id'=>Category::inRandomOrder()->first()->id,
               'title'=>$factory->sentence(4),
               'body'=>$factory->paragraph(),
               'image'=>sprintf("%02d",$i).'.jpeg',
            ]);
        }
    }
}
