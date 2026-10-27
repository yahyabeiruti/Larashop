<!-- layout.blade.php -->
<!DOCTYPE html>
<html lang="en"> 

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Larashop</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite('resources/css/app.css')
        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body class="bg-[#f1faee]">
        <header>
            @yield('header')
            @if(session('success'))
                <div class="mx-auto mt-4 max-w-7xl rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))

            <div class="mx-auto mt-4 max-w-7xl rounded-lg bg-red-100 p-4 text-red-800">
                {{ session('error') }}
            </div>
            @endif
           
        </header>

        <main>
            @yield('main')
        </main>

        <footer>
            @yield('footer')
        </footer>
    </body>

</html>