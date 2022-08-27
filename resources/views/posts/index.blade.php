@extends('layouts.master')

@section('body')
    @forelse ($posts as $post)
        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="{{ route('posts.show', $post) }}" class="hover:opacity-75">
                <img src="https://source.unsplash.com/collection/1346951/1000x500?sig={{ rand(1, 9) }}">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <!-- Category -->
                <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
                <!-- Title -->
                <a href="{{ route('posts.show', $post) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">
                    {{ $post->title }}
                </a>
                <p href="#" class="text-sm pb-3">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->author->name }}</a>, Published on {{ $post->created_at->toFormattedDateString() }}
                </p>
                <a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
                <a href="{{ route('posts.show', $post) }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
            </div>
        </article>
    @empty
        <p class="font-semibold mt-5">No hay publicaciones</p>
    @endforelse

    @if(count($posts) > 0)
        {{ $posts->links() }}
    @endif
@stop
