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


        <form name="registerform" action="/entryexit/store" method="post" id="registerform">
        @csrf
        <div class="w-11/12 mx-4">
            <div class="w-full">  
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        入出庫伝票番号
                    </label>
                    <input name="slipno" disabled class="bg-gray-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg" id="no" type="text">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        伝票区分
                    </label>
                        <select name="slipdiv">
                            @foreach($comboboxs->getSlipDivs() as $slipDiv)
                                
                            <option value="{{$slipDiv}}">{{$slipDiv}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        伝票日付
                    </label>
                    <input name="slipdate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="day" type="date">
                    </div>
                </div>
                
            </div>
        
            <!-- ヘッダごとスクロールさせたいのでスクロールする枠で囲います -->
            <h3>入出庫明細</h3>
            <div class="overflow-x-scroll">
                <!--jsにて明細分だけフォームを追加します -->
                <table class="w-screen divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                                明細区分
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                                商品名
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                                倉庫名
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                                数量
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                                単位
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-left">
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <select name="detaildiv">
                                    @foreach($comboboxs->getDetailDivs() as $detailDiv)
                                        <option value="{{$detailDiv}}">{{$detailDiv}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <select name="itemname">
                                    @foreach($comboboxs->getItems() as $item)
                                        <option value="{{$item->getName()}}">{{$item->getName()}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                            <select name="warehousename">
                                    @foreach($comboboxs->getWarehouses() as $warehouse)
                                        <option value="{{$warehouse->getName()}}">{{$warehouse->getName()}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <input name="count" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg" id="no" type="number" min:1 require>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap">
                            <input name="unit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg" id="no" type="text" require>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <input type="hidden" name="lastupdate" value="" />
            
            <button type="submit" name="action" value="send" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 mt-6 px-4 rounded">
                登録
            </button>
        </form>    

        </div>
    </body>
</html>
