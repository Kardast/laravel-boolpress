<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = ['uncategorized', 'Cucina', 'Politica', 'Sport', 'Cronaca', 'Animali', 'Viaggi'];

        foreach($categories as $category) {
            Category::create([
                'slug'          => Category::getSlug($category),
                'name'          => $category,
                'description'   => $faker->paragraphs(rand(2, 10), true),
            ]);
        }
    }
}
