<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center py-3 text-indigo-800 font-bold">
                Path History: <span class="mx-2 py-1 px-3 bg-green-400"></span>
            </div>

            <div class="flex justify-center py-3 text-indigo-800 font-bold">
                Current Robot Location:
                <span class="bg-red-400 px-1"> {{ $xLocation }} , {{ $yLocation }} </span>
            </div>

            <div class="flex justify-center my-3">
                @include('robot._form', ['xLocation' => $xLocation, 'yLocation' => $yLocation])
            </div>

            <div>
                @include('robot._grid', [
                'xLocation' => $xLocation,
                'yLocation' => $yLocation,
                'pathHistory' => $pathHistory,
                'xMin' => $xMin,
                'xMax' => $xMax,
                'yMin' => $yMin,
                'yMax' => $yMax,
                ])
            </div>

        </div>
    </div>
</body>

</html>
