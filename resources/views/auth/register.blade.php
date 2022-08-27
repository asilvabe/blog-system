@extends('layouts.master')

@section('body')
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="flex flex-col items-center my-4">
            <h1 class="text-2xl uppercase font-bold">Register</h1>
            <div class="mt-5">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input id="name" type="text" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}">
                @error('name')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="mt-5">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input id="email" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" type="text" name="email">
                @error('email')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="mt-5">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input id="password" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" type="password" name="password">
                @error('password')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="mt-5">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm password</label>
                <input id="password_confirmation" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password_confirmation') border-red-500 @enderror" type="password" name="password_confirmation">
                @error('password_confirmation')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>
            <div class="flex flex-row">
                <button type="submit" class="bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-5 py-3 mt-4">Register</button>
            </div>
        </div>
    </form>
@stop
