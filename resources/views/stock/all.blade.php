<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>在庫状況</title>
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div>
            <table class="table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">商品名</th>
                        <th class="px-4 py-2">倉庫名</th>
                        <th class="px-4 py-2">在庫数</th>
                    </tr>
                </thead>
                <tbody>    
                    @foreach($stocks as $stock)
                        <tr>
                            <td class="border px-4 py-2">{{ $stock->getItemName() }}</td>
                            <td class="border px-4 py-2">{{ $stock->getWarehouseName() }}</td>
                            <td class="border px-4 py-2">{{ $stock->getCount() }}</td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
