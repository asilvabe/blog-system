<!-- Top Bar Nav -->
<nav class="w-full py-4 bg-blue-800 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
        <nav>
            <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                <li><a class="hover:text-gray-200 hover:underline px-4" href="/">Home</a></li>

                @if (Route::has('login'))
                    @auth
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <li><button type="submit" class="hover:text-gray-200 uppercase font-bold hover:underline px-4" href="#">Logout</button></li>
                        </form>
                    @else
                        <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                            <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </nav>

        <div class="flex items-center text-lg no-underline text-white pr-6">
            <a class="" href="#">
                <i class="fab fa-facebook"></i>
            </a>
            <a class="pl-6" href="#">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="pl-6" href="#">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="pl-6" href="#">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    </div>
</nav>
