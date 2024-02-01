<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">


    @include('layouts.guestNav')

    <main class="bg-slate-100">
        <div class="max-w-full py-12 px-2 mt-7 container flex justify-center">
            <div class="m-auto grid grid-cols-1 md:grid-cols-5 lg:grid-cols-6 gap-4">
                @yield('content')
                <div
                    class="rounded-md bg-white flex flex-col justify-start items-start md:w-4/5 lg:w-4/6 tile col-span-1 md:col-span-2 lg:col-span-2 px-3">
                    <div class="my-3">
                        <h3
                            class="my-2 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl dark:text-white">
                            Categories</h3>
                        @foreach ($categories as $category)
                            <p>
                                <a
                                    class="flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $category->name }}</a>
                            </p>
                        @endforeach
                    </div>

                    <div>
                        <h3
                            class="my-2 text-xl font-bold leading-none tracking-tight text-gray-700 md:text-2xl dark:text-white">
                            Latest News</h3>
                        @foreach ($latestNews as $latest)
                            <div class="w-3/4 py-2">
                                <img src="{{ asset($latest->banner_image) }}" />
                                <p>
                                    <a
                                        class="pt-2 mb-3 flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $latest->title }}</a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>



    <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Laravel
                        News</span>
                </a>
                <ul
                    class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a
                    href="https://localhost:8000/" class="hover:underline">Laravel News</a>. All Rights Reserved.</span>
        </div>
    </footer>




</body>

</html>
