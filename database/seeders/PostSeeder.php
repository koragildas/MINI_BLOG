<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            Post::create([
                'title' => $faker->sentence(6, true),
                'content' => $faker->paragraphs(5, true),
                'author' => $faker->name(),
                'status' => $faker->randomElement(['draft', 'published']),
                'excerpt' => $faker->paragraph(2),
                'tags' => $faker->randomElements([
                    'Laravel', 'PHP', 'React', 'JavaScript', 'API',
                    'Web Development', 'Tutorial', 'Programming'
                ], $faker->numberBetween(1, 4)),
                'views' => $faker->numberBetween(0, 1000),
            ]);
        }
    }
}
