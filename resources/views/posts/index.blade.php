@extends('layouts.master')

@section('body')
    @if (session('status'))
        <div class="bg-green-200 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg></div>
                <div>
                    <p class="font-bold mb-0">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif
    @if (auth()->check() && auth()->user()->isAdmin())
        <div class="flex flex-col my-4">
            <form action="{{ route('posts.index') }}" method="get">
                <div class="grid gap-6 mb-6 md:grid-cols-5">
                    <div>
                        <span class="text-sm text-gray-500">SEARCH</span>
                        <input
                            type="text"
                            id="title_search"
                            name="title_search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Title Search"
                            value="{{ request()->get('title_search') ?? '' }}"
                        >
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">FROM</span>
                        <input
                            type="date"
                            id="date_from"
                            name="date_from"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ request()->get('date_from') ?? '' }}"
                        >
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">TO</span>
                        <input
                            type="date"
                            id="date_to"
                            name="date_to"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ request()->get('date_to') ?? '' }}"
                        >
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">AUTHOR</span>
                        <select
                            id="author"
                            name="author"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value='0' @selected(request()->get('author') == 0)>Select Author</option>
                            @foreach ($users as $user)
                                <option value='{{ $user->id }}' @selected(request()->get('author') == $user->id)>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">STATUS</span>
                        <select
                            id="status"
                            name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0" @selected(request()->get('status') == 0)>All</option>
                            <option value="1" @selected(request()->get('status') == 1)>Approved</option>
                            <option value="2" @selected(request()->get('status') == 2)>Pending</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center">
                    <button
                        type="submit"
                        class="bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-5 py-3"
                    >Search</button>
                    <a class="ml-4" href="{{ route('posts.index') }}">Limpiar filtros</a>
                </div>
            </form>

            <table class="border-separate border-spacing-2 border-slate-400 mt-5">
                <thead>
                    <tr class="text-left">
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date Post</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>
                                <a href="{{ route('posts.show', $post) }}"
                                    class="text-1xl text-blue-700 hover:underline pb-4">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td>{{ $post->author->name }}</td>
                            <td>{{ $post->created_at->toFormattedDateString() }}</td>
                            <td class="text-center">
                                @if ($post->isApproved())
                                    <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Approved</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">There are no posts</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (count($posts) > 0)
            {{ $posts->links() }}
        @endif
    @endIf
@stop
