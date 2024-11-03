<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="bg-gray-500 text-black dark:bg-gray-500 dark:text-white">
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                <div class="flex lg:justify-center lg:col-start-2">
                    <h1 class="text-3xl text-white">Terméknyilvántartó</h1>
                </div>
            </header>

            <main class="mt-6">
                <div class="grid gap-6 grid-cols-1 lg:gap-8">
                    <div class="p-4 rounded bg-white">
                        <h1 class="text-xl text-black mb-4">Termékek létrehozása, módosítása</h1>
                        @session('success')
                        <div class="bg-green-100 text-black rounded border-red p-2 mb-3" role="alert">
                            <ul>
                                <li>{{ $value }}</li>
                            </ul>
                        </div>
                        @endsession
                        @if ($errors->any())
                            <div class="bg-red-100 text-black rounded border-red p-2 mb-3" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="file" class="text-black">Állomány kiválasztása:</label>
                            <br/>
                            <input type="file" name="file" accept=".csv,.txt" class="text-black py-4">
                            <p class="mt-1 text-sm text-black" id="file_input_help">CSV vagy txt állomány adható
                                meg.</p>
                            <hr class="py-2 mt-4"/>
                            <button type="submit"
                                    class="px-4 py-2 font-semibold text-sm bg-amber-500 text-black rounded-full shadow-sm text-bold">
                                Állomány betöltése
                            </button>
                            <br/>
                            <span class="text-gray-500 text-sm">A betöltött állomány feldolgozása az állomány méretétől függően több percig is eltarthat.</span>
                        </form>
                    </div>
                    <div class="p-4 rounded bg-white">
                        <h1 class="text-xl text-black mb-4">Terméklista XML Feed</h1>
                        <a href="{{ route('xml-feed') }}"
                           class="px-4 py-2 font-semibold text-sm bg-amber-500 text-black rounded-full shadow-sm text-bold"
                           target="_blank">XML feed megnyitása</a>
                    </div>
                    <div class="p-4 rounded bg-white text-black">
                        <h1 class="text-black text-2xl mb-4">Második rész megoldása:</h1>
                        <code>SELECT
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;product_packages.id,
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;SUM(
                            price_history.price * product_package_contents.quantity
                            ) AS price
                            <br/>
                            FROM
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;product_packages
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;LEFT JOIN product_package_contents ON
                            product_package_contents.product_package_id =
                            product_packages.id
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;LEFT JOIN products ON product_package_contents.product_id =
                            products.id
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;LEFT JOIN price_history ON price_history.product_id = products.id
                            <br/>
                            WHERE
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;product_packages.id = :id
                            <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;AND DATE(price_history.updated_at) <= :date
                            <br/>
                            GROUP BY
                            product_packages.id;</code>
                        <br/>
                        <br/>
                        Az :id helyére a termékcsoport-azonosítót, a :date helyére az időpontot YYYY-mm-dd formában
                        szükséges megadni.
                    </div>
                </div>
            </main>

            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </div>
</div>
</body>
</html>
