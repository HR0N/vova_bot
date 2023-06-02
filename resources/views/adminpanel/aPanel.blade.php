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

    {{--    jQuery (not slim, because CRUD need) --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    {{--    Pieces of shit...  --}}
    <?php if($_SERVER['SERVER_NAME'] === '127.0.0.1'): ?>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <?php else: ?>
    <link rel="stylesheet" href="{{asset('./public/build/assets/app-1e482a66.css')}}">
    <script src="{{asset('./public/build/assets/app-9d60067e.js')}}"></script>
    <?php endif; ?>

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

        @auth
            @if(Auth()->user()->role == 'admin')
                <main>

                    <div class="choose">
                        <div class="title">Виберіть групу та категорію парсингу</div>
                        <div class="choose__group">
                            <label for="group">Виберіть групу</label>
                            <select class="form-control" name="group" id="group">
                                <option selected disabled></option>
                                <option value="1">tmp 1</option>
                                <option value="2">tmp 2</option>
                            </select>
                        </div>
                        <div class="choose__category">
                            <div>
                                <label for="category">Виберіть категорію</label>
                                <select class="form-control" name="category" id="category">
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
                                    <select class="form-control" name="apartment__city">
{{--                                        <option selected disabled></option>--}}
                                        <option value="Warszawa">Warszawa</option>
                                    </select>
                                </label>
                            </div>

                            <div class="section">
                                <label><span class="l_title">Район</span>
                                    <select class="form-control" name="apartment__district">
                                        <option value="Bemowo">Bemowo</option>
                                        <option value="Białołęka">Białołęka</option>
                                        <option value="Bielany">Bielany</option>
                                        <option value="Mokotów">Mokotów</option>
                                        <option value="Ochota">Ochota</option>
                                        <option value="Praga-Południe">Praga-Południe</option>
                                        <option value="Praga-Północ">Praga-Północ</option>
                                        <option value="Rembertów">Rembertów</option>
                                        <option value="Targówek">Targówek</option>
                                        <option value="Ursus">Ursus</option>
                                        <option value="Ursynów">Ursynów</option>
                                        <option value="Wola">Wola</option>
                                        <option value="Wesoła">Wesoła</option>
                                        <option value="Włochy">Włochy</option>
                                        <option value="Wilanów">Wilanów</option>
                                        <option value="Wawer">Wawer</option>
                                        <option value="Śródmieście">Śródmieście</option>
                                        <option value="Żoliborz">Żoliborz</option>
                                    </select>
                                </label>
                            </div>

                            <div class="section">
                                <label><span class="l_title">Ціна</span>
                                    <input class="form-control" name="apartment__price_from" placeholder="Від:"/>
                                    <input class="form-control" name="apartment__price_to" placeholder="до:"/>
                                </label>
                            </div>

                            <div class="section section__apartment_rooms">
                                <label><span class="l_title">Кількість кімнат</span>
                                    <label><input type="checkbox" name="all" checked> Всі</label>
                                    <label><input type="checkbox" name="one"> Одна</label>
                                    <label><input type="checkbox" name="two"> Дві</label>
                                    <label><input type="checkbox" name="three"> Три</label>
                                    <label><input type="checkbox" name="four"> Чотири</label>
                                    <label><input type="checkbox" name="five"> П'ять</label>
                                </label>
                            </div>

                            <div class="buttons">
                                <div class="btn btn-outline-success submit">Зберегти</div>
                            </div>

                        </form>
                    </div>

                    <div class="filters rooms">
                        <div class="title">Фільтри з оренди кімнат</div>
                        <form class="form-control" action="#">

                            <div class="section">
                                <label><span class="l_title">Город</span>
                                    <select class="form-control" name="apartment__city">
                                        {{--                                        <option selected disabled></option>--}}
                                        <option value="Warszawa">Warszawa</option>
                                    </select>
                                </label>
                            </div>

                            <div class="section">
                                <label><span class="l_title">Район</span>
                                    <select class="form-control" name="apartment__district">
                                        <option value="Bemowo">Bemowo</option>
                                        <option value="Białołęka">Białołęka</option>
                                        <option value="Bielany">Bielany</option>
                                        <option value="Mokotów">Mokotów</option>
                                        <option value="Ochota">Ochota</option>
                                        <option value="Praga-Południe">Praga-Południe</option>
                                        <option value="Praga-Północ">Praga-Północ</option>
                                        <option value="Rembertów">Rembertów</option>
                                        <option value="Targówek">Targówek</option>
                                        <option value="Ursus">Ursus</option>
                                        <option value="Ursynów">Ursynów</option>
                                        <option value="Wola">Wola</option>
                                        <option value="Wesoła">Wesoła</option>
                                        <option value="Włochy">Włochy</option>
                                        <option value="Wilanów">Wilanów</option>
                                        <option value="Wawer">Wawer</option>
                                        <option value="Śródmieście">Śródmieście</option>
                                        <option value="Żoliborz">Żoliborz</option>
                                    </select>
                                </label>
                            </div>

                            <div class="section">
                                <label><span class="l_title">Ціна</span>
                                    <input class="form-control" name="rooms__price_from" placeholder="Від:"/>
                                    <input class="form-control" name="rooms__price_to" placeholder="до:"/>
                                </label>
                            </div>

                            {{--<div class="section section__rooms_rooms">
                                <label><span class="l_title">Кількість кімнат</span>
                                    <label><input type="checkbox" checked> Всі</label>
                                    <label><input type="checkbox"> Одна</label>
                                    <label><input type="checkbox"> Дві</label>
                                    <label><input type="checkbox"> Три</label>
                                    <label><input type="checkbox"> Чотири</label>
                                    <label><input type="checkbox"> П'ять</label>
                                </label>
                            </div>--}}

                            <div class="buttons">
                                <div class="btn btn-outline-success submit">Зберегти</div>
                            </div>

                        </form>
                    </div>

                </main>
            @endif
        @endauth

</div>
</body>
</html>
