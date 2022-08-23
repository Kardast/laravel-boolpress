<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private function fixImageUrl($imgPath) {
        return $imgPath ? asset('/storage/' . $imgPath) : null;
    }

    //Display a listing of the resource.
    public function index(Request $request)
    {
        $per_page_default = 10;
        $per_page = $request->query('per_page', $per_page_default);
        if ($per_page < 1 || $per_page > 100) {
            $per_page = $per_page_default;
            // return response()->json(['success' => false], 400);
        }

        $posts = Post::with(['user', 'category', 'tags'])->paginate($per_page);

        foreach ($posts as $post) {
            $post->image = $this->fixImageUrl($post->image);
        }

        return response()->json([
            'success'   => true,
            'response'  => $posts
        ]);
    }

    // Restituisce 9 post random per la homepage in Vue
    public function random() {
        $sql = Post::with(['user', 'category', 'tags'])->whereNotNull('image')->limit(21)->inRandomOrder();
        $posts = $sql->get();

        foreach ($posts as $post) {
            $post->image = $this->fixImageUrl($post->image);
        }

        return response()->json([
            // 'sql'       => $sql->toSql(), // solo per debugging
            'success'   => true,
            'result'    => $posts,
        ]);
    }

    //Display the specified resource.
    public function show($slug)
    {
        $post = Post::with(['user', 'category', 'tags'])->where('slug', $slug)->first();

        if ($post) {
            $post->image = $this->fixImageUrl($post->image);
            return response()->json([
                'success'   => true,
                'result'    => $post
            ]);
        } else {
            return response()->json([
                'success'   => false,
            ]);
        }
    }
}
