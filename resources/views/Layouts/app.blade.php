<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Application')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">

    <!-- Header -->
    <header>
        <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/" class="flex items-center space-x-3">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Logo">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">MyApp</span>
                </a>
                <div class="hidden w-full md:flex md:items-center md:justify-between md:w-auto" id="navbar-sticky">
                    <ul class="flex flex-col md:flex-row md:space-x-8 p-4 md:p-0 font-medium bg-white dark:bg-gray-800">
                        <li><a href="{{ route('home') }}" class="py-2 px-3 rounded md:hover:bg-transparent md:hover:text-blue-700">Home</a></li>
                        <li><a href="#about" class="py-2 px-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700">About</a></li>
                        <li><a href="#services" class="py-2 px-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Services</a></li>
                        <li><a href="#contact" class="py-2 px-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="pt-20 min-h-screen bg-gray-50 dark:bg-gray-900">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 w-full border-t border-gray-200 dark:border-gray-600">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/" class="flex items-center">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="Logo" />
                        <span class="self-center text-2xl font-semibold dark:text-white">MyApp</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Privacy Policy</a>
                    <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
