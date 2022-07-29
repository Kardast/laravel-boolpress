@extends('admin.layouts.base')

@section('mainContent')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <table class="table table-striped">


        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody>
            @php
                $posts = $category->posts()->paginate(5);
            @endphp
            @foreach ($posts as $post)
                <tr>
                    <td>
                        <a href="{{ route('admin.posts.show', ['post' =>$post]) }}">{{ $post->title }}</a>
                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('admin.tags.show', ['tag' => $tag]) }}">{{ $tag->name }}</a>
                            @if(!$loop->last) , @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

@endsection
