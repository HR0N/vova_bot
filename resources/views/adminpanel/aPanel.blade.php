<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OLX Message Bot</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{--    jQuery (not slim, because CRUD need) --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    {{--    Pieces of shit...  --}}
    <?php if($_SERVER['SERVER_NAME'] === '127.0.0.1'): ?>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <?php else: ?>
    <link rel="stylesheet" href="{{asset('./public/build/assets/app-3aaac750.css')}}">
    <script src="{{asset('./public/build/assets/app-799273ba.js')}}"></script>
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
                            <select class="form-control" name="group" id="groups">
                                <option selected disabled></option>
                                {{--<option value="1">tmp 1</option>
                                <option value="2">tmp 2</option>--}}
                            </select>
                        </div>
                        <div class="choose__category">
                            <div>
                                <label for="category">Виберіть категорію</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="apartment">Оренда квартир</option>
                                    <option value="rooms">Оренда кімнат</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="filters apartment filters_hide">
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
                                        <option value="0">Całe miasto</option>
                                        <option value="367">Bemowo</option>
                                        <option value="365">Białołęka</option>
                                        <option value="369">Bielany</option>
                                        <option value="353">Mokotów</option>
                                        <option value="355">Ochota</option>
                                        <option value="381">Praga-Południe</option>
                                        <option value="379">Praga-Północ</option>
                                        <option value="361">Rembertów</option>
                                        <option value="377">Targówek</option>
                                        <option value="371">Ursus</option>
                                        <option value="373">Ursynów</option>
                                        <option value="359">Wola</option>
                                        <option value="533">Wesoła</option>
                                        <option value="357">Włochy</option>
                                        <option value="375">Wilanów</option>
                                        <option value="383">Wawer</option>
                                        <option value="351">Śródmieście</option>
                                        <option value="363">Żoliborz</option>
                                    </select>
                                </label>
                            </div>

                            <div class="section">
                                <label><span class="l_title">Ціна</span>
                                    <input class="form-control" name="price1" placeholder="Від:"/>
                                    <input class="form-control" name="price2" placeholder="до:"/>
                                </label>
                            </div>

                            <div class="section section__apartment_rooms">
                                <label><span class="l_title">Кількість кімнат</span>
                                    <label><input type="checkbox" name="all" checked> Всі</label>
                                    <label><input type="checkbox" name="r1"> Одна</label>
                                    <label><input type="checkbox" name="r2"> Дві</label>
                                    <label><input type="checkbox" name="r3"> Три</label>
                                    <label><input type="checkbox" name="r4"> Чотири</label>
{{--                                    <label><input type="checkbox" name="r5"> П'ять</label>--}}
                                </label>
                            </div>

                            <div class="buttons">
                                <div class="btn btn-outline-success submit">Зберегти</div>
                            </div>

                        </form>
                    </div>

                    <div class="filters rooms filters_hide">
                        <div class="title">Фільтри з оренди кімнат</div>
                        <form class="form-control" action="#">

                            <div class="section">
                                <label><span class="l_title">Город</span>
                                    <select class="form-control" name="rooms__city">
                                        {{--                                        <option selected disabled></option>--}}
                                        <option value="Warszawa">Warszawa</option>
                                    </select>
                                </label>
                            </div>

                            <div class="section">
                                <label><span class="l_title">Район</span>
                                    <select class="form-control" name="rooms__district">
                                        <option value="0">Całe miasto</option>
                                        <option value="367">Bemowo</option>
                                        <option value="365">Białołęka</option>
                                        <option value="369">Bielany</option>
                                        <option value="353">Mokotów</option>
                                        <option value="355">Ochota</option>
                                        <option value="381">Praga-Południe</option>
                                        <option value="379">Praga-Północ</option>
                                        <option value="361">Rembertów</option>
                                        <option value="377">Targówek</option>
                                        <option value="371">Ursus</option>
                                        <option value="373">Ursynów</option>
                                        <option value="359">Wola</option>
                                        <option value="533">Wesoła</option>
                                        <option value="357">Włochy</option>
                                        <option value="375">Wilanów</option>
                                        <option value="383">Wawer</option>
                                        <option value="351">Śródmieście</option>
                                        <option value="363">Żoliborz</option>
                                    </select>
                                </label>
                            </div>

                            <div class="section">
                                <label><span class="l_title">Ціна</span>
                                    <input class="form-control" name="price1" placeholder="Від:"/>
                                    <input class="form-control" name="price2" placeholder="до:"/>
                                </label>
                            </div>

                            <div class="buttons">
                                <div class="btn btn-outline-success submit">Зберегти</div>
                            </div>

                        </form>
                    </div>
                    <div class="modal_update filters_hide">
                        <div class="message">Збережено!</div>
                    </div>

                </main>
            @endif
        @endauth

</div>
</body>
</html>
