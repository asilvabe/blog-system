@extends('layouts.master')

@section('body')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="flex flex-col items-center my-4">
            <h1 class="text-2xl uppercase font-bold">Login</h1>
            <div class="mt-5">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input id="email" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" type="text" name="email" value="{{ old('email') }}">
                @error('email')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="mt-5">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input id="password" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" type="password" name="password">
                @error('password')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="flex flex-row">
                <button type="submit" class="bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-5 py-3 mt-4">Login</button>
            </div>
        </div>
    </form>
@stop
