<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Italy', 'Macroeconomics', 'Js', 'OOP', 'Vue', 'Laravel', 'Eggs', 'Tomatoes', 'Writing', 'Reading'];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
