<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body class="apanel">
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 header">
        <div class="welcome">
            <a href="{{ url('/') }}" class="welcome font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Welcome</a>
        </div>
        <div class="links">
            @auth
                {{--@if(Auth()->user()->role == 'admin')
                    <a href="{{ url('/adminpanel') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">A Panel</a>
                @endif--}}
                <div aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    </div>
    @endif

        @if(Auth()->user()->role == 'admin')
            <main>

                <div class="choose">
                    <div class="title">Оберіть групу та категорію парсингу</div>
                    <div class="choose__group">
                        <label for="group">Виберіть групу</label>
                        <select  class="form-control" name="group" id="group">
                            <option selected disabled></option>
                            <option value="1">tmp 1</option>
                            <option value="2">tmp 2</option>
                        </select>
                    </div>
                    <div class="choose__category">
                        <div>
                            <label for="category">Виберіть категорію</label>
                            <select  class="form-control" name="category" id="category">
                                <option value="0">Оренда квартир</option>
                                <option value="1">Оренда кімнат</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="filters apartment">
                    <div class="title">Фільтри з оренди квартир</div>
                    <form class="form-control" action="#">

                        <div class="section">
                            <label><span class="l_title">Город</span>
                                <input class="form-control" type="text" name="apartment__city">
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Район</span>
                                <input class="form-control" type="text" name="apartment__district">
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Кількість кімнат</span>
                                <select class="form-control" name="apartment__room_count">
                                    <option value="0">Всі оголошення</option>
                                    <option value="1">1 кімната</option>
                                    <option value="2">2 кімнати</option>
                                    <option value="3">3 кімнати</option>
                                    <option value="4">4 кімнати</option>
                                    <option value="5">5 кімнат</option>
                                </select>
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Ціна</span>
                                <input class="form-control" name="apartment__price_from" placeholder="Від:"/>
                                <input class="form-control" name="apartment__price_to" placeholder="до:"/>
                            </label>
                        </div>

                    </form>
                </div>

                <div class="filters rooms">
                    <div class="title">Фільтри з оренди кімнат</div>
                    <form class="form-control" action="#">

                        <div class="section">
                            <label><span class="l_title">Город</span>
                                <input class="form-control" type="text" name="rooms__city">
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Район</span>
                                <input class="form-control" type="text" name="rooms__district">
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Кількість кімнат</span>
                                <select class="form-control" name="rooms__room_count">
                                    <option value="0">Всі оголошення</option>
                                    <option value="1">1 кімната</option>
                                    <option value="2">2 кімнати</option>
                                    <option value="3">3 кімнати</option>
                                    <option value="4">4 кімнати</option>
                                    <option value="5">5 кімнат</option>
                                </select>
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Ціна</span>
                                <input class="form-control" name="rooms__price_from" placeholder="Від:"/>
                                <input class="form-control" name="rooms__price_to" placeholder="до:"/>
                            </label>
                        </div>

                    </form>
                </div>

            </main>
        @endif

</div>
</body>
</html>
