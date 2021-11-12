<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>入出庫伝票登録画面</title>
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

            @foreach($slips as $slip)
                <hr />
                <div class="mt-6 ml-6">
                    入出庫伝票番号:{{ $slip->getEntryExitId() }}
                    <br />
                    {{ $slip->getSlipDate()->format('Y/m/d') }}
                    {{ $slip->getSlipDiv() }}
                    
                    <!--明細用テーブル-->
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">明細区分</th>
                                <th class="px-4 py-2">商品名</th>
                                <th class="px-4 py-2">倉庫名</th>
                                <th class="px-4 py-2">数量</th>
                                <th class="px-4 py-2">単位</th>
                                <th class="px-4 py-2">編集</th>
                                <th class="px-4 py-2">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @foreach($slip->getDetails() as $detail)
                                <td class="border px-4 py-2">{{ $detail->getDetailDiv() }}</td>
                                <td class="border px-4 py-2">{{ $detail->getItemName() }}</td>
                                <td class="border px-4 py-2">{{ $detail->getWarehouseName() }}</td>
                                <td class="border px-4 py-2">{{ $detail->getCount() }}</td>
                                <td class="border px-4 py-2">{{ $detail->getUnit() }}</td>
                                <td class="border px-4 py-2">
                                    <a href="/entryexit/edit/{{ $slip->getEntryExitId() }}">編集</a>
                                </td>
                                <td class="border px-4 py-2">削除</td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach

        </div>


    </body>
</html>
