<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>商品登録画面</title>
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

            @isset($errors)
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endisset


            <div class="w-2/3">
                <h2>商品登録<h2>
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"name="registerform" action="/item/store" method="post" id="registerform">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            商品名
                        </label>
                        <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" type="text">
                        </div>

                        <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            値段
                        </label>
                        <input class="shadow appearance-none border rounded w-40 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="price" type="number" min="1">
                        </div>

                        <button type="submit" name="action" value="send" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 mt-6 px-4 rounded">
                            登録
                        </button>

                    </div>
                </form>
            </div>
        
        </div>
    </body>
</html>
