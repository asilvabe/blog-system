@extends('layouts.master')

@section('body')

    @if (session('status'))
        <div class="bg-green-200 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold mb-0">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    @auth
        <div class="flex">
            <a href="{{ route('posts.create') }}" class="bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 px-5 py-3 mt-4">
                Create new post
            </a>
        </div>
    @endauth

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
                <p class="pb-6">{{ $post->body }}</p>
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
