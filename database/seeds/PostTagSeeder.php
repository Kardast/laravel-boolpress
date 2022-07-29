<?php

use App\Models\Tag;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();
        $tags = Tag::all()->pluck('id');
        $nTags = count($tags);

        foreach ($posts as $post) {
            $postTags = $faker->randomElements($tags, rand(0, $nTags));
            foreach ($postTags as $tagId) {
                $post->tags()->attach($tagId);
            }
        }
    }
}
