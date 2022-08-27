@extends('layouts.master')

@section('body')
    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        <div class="flex flex-col w-full my-4">
            <h1 class="text-3xl font-bold">Create Post</h1>
            <div class="flex flex-col mt-5">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" type="text" name="title" placeholder="Write text here" value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col mt-5">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                <textarea id="body" name="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('body') border-red-500 @enderror" placeholder="Write body test here" rows="5">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-row">
            <button type="submit" class="bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-5 py-3 mt-4">Save post</button>
            <button type="reset" class="text-sm uppercase rounded flex items-center justify-center px-5 py-3 mt-4">Reset</button>
        </div>
    </form>
@stop
