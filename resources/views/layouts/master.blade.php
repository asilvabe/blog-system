<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Blog Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>
<body class="bg-white font-family-karla">

@include('layouts.partials.navbar')
@include('layouts.partials.header')
@include('layouts.partials.topic-nav')

<div class="container mx-auto flex flex-wrap py-6">

    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
        @yield('body')
    </section>

    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

        <div class="w-full bg-white shadow flex flex-col my-4 p-6">
            <p class="text-xl font-semibold pb-5">About Us</p>
            <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
            <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                Get to know us
            </a>
        </div>

        <div class="w-full bg-white shadow flex flex-col my-4 p-6">
            <p class="text-xl font-semibold pb-5">Instagram</p>
            <div class="grid grid-cols-3 gap-3">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
            </div>
            <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
            </a>
        </div>
    </aside>

</div>

@include('layouts.partials.footer')

<script>
    function getCarouselData() {
        return {
            currentIndex: 0,
            images: [
                'https://source.unsplash.com/collection/1346951/800x800?sig=1',
                'https://source.unsplash.com/collection/1346951/800x800?sig=2',
                'https://source.unsplash.com/collection/1346951/800x800?sig=3',
                'https://source.unsplash.com/collection/1346951/800x800?sig=4',
                'https://source.unsplash.com/collection/1346951/800x800?sig=5',
                'https://source.unsplash.com/collection/1346951/800x800?sig=6',
                'https://source.unsplash.com/collection/1346951/800x800?sig=7',
                'https://source.unsplash.com/collection/1346951/800x800?sig=8',
                'https://source.unsplash.com/collection/1346951/800x800?sig=9',
            ],
            increment() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex + 1;
            },
            decrement() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex - 1;
            },
        }
    }
</script>

</body>
</html>
